angular.module('PxdmSite.about', ['ngRoute', 'ui.router']).config(function($stateProvider, $urlRouterProvider) {
    $stateProvider.state('/about', {
        url: '/about',
        templateUrl: 'information/about/about.html?v=' + new Date(),
        controller: 'InfoCtrl',
        data: {
            pageTitle: 'About us - PriceDrummer.com.gh'
        }
    }).state('/press', {
        url: '/press',
        templateUrl: 'information/press/press.html?v=' + new Date(),
        controller: 'InfoCtrl',
        data: {
            pageTitle: 'Press Page'
        }
    }).state('/contact', {
        url: '/contact',
        templateUrl: 'information/contact/contact.html?v=' + new Date(),
        controller: 'InfoCtrl',
        data: {
            pageTitle: 'Contact Page'
        }
    }).state('/careers', {
        url: '/careers',
        templateUrl: 'information/careers/careers.html?v=' + new Date(),
        controller: 'InfoCtrl',
        data: {
            pageTitle: 'Careers Page'
        }
    }).state('/all_categories', {
        url: '/all_categories',
        templateUrl: 'information/categories/categories.html?v=' + new Date(),
        controller: 'InfoCtrl',
        data: {
            pageTitle: 'All Categories - PriceDrummer'
        }
    })
}).controller('InfoCtrl', ['myService', 'CategoryList', '$http', '$rootScope', '$log', '$scope', '$window', function(myService, CategoryList, $http, $rootScope, $log, $scope, $window) {
    myService.async().then(function(Token_data) {
        $scope.$on('$viewContentLoaded', function(event) {
            $window.ga('send', 'pageview', { page: $location.absUrl() });
        });
        $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
        $rootScope.FILTER_PAGE_REFERENCE_VALUES_RESET();
        $rootScope.PageLoaded = true;
        var str = 'abcdefghijklmnopqrstuvwxyz';
        $scope.alphabets = str.toUpperCase().split("");
        $scope.activeLetter = '';
        $scope.activateLetter = function(letter) {
            $scope.activeLetter = letter
        }
        if ($rootScope.all_level3n4 != 'undefined' || $rootScope.all_level3n4 != "") {
            $http({
                method: 'GET',
                url: 'https://api.pricedrummer.com.gh/categories/?has_product=1&level=3%2C4&limit=1000',
                cache: true
            }).then(function(response) {
                $rootScope.all_level3n4 = response.data.results;
            })
        }
        $('html,body').animate({
            scrollTop: 0
        }, 200);
    });
}]).filter('startsWithLetter', function() {
    return function(items, letter) {
        var filtered = [];
        var letterMatch = new RegExp(letter, 'i');
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            if (letterMatch.test(item.name.substring(0, 1))) {
                filtered.push(item);
            }
        }
        return filtered;
    };
}).service('CategoryList', function($http, $q) {
    var cache;

    function getCategories() {
        var d = $q.defer();
        if (cache) {
            d.resolve(cache);
        } else {
            $http({
                method: 'GET',
                url: 'https://api.pricedrummer.com.gh/categories/?has_product=1&level=3%2C4&limit=1000'
            }).success(function(response) {
                cache = response.data.results;
                d.resolve(cache);
            }).error(function(error) {
                d.reject(error);
            })
        }
        return d.promise;
    }

    function clearCache() {
        cache = null;
    }
    return {
        getCategories: getCategories,
        clearCache: clearCache
    };
})