angular.module('PxdmSite.home', ['ngRoute', 'ui.router', 'ui.bootstrap'])
    .config(function ($stateProvider) {
        $stateProvider.state('/', {
            url: '/',
            templateUrl: 'home/home.html?v=' + new Date(),
            controller: 'HomeCtrl',
            ncyBreadcrumb: {
                label: 'Home page'
            },
            data: {
                pageTitle: 'Compare Prices - Smart Shopping in Ghana'
            }
        }).state('/all-categories', {
            url: '/all-categories',
            templateUrl: 'home/all_categories.html?v=' + new Date(),
            controller: 'HomeCtrl',
            ncyBreadcrumb: {
                label: 'Home page'
            },
            data: {
                pageTitle: 'Compare Prices - All Categories'
            }
        })
    })
    .controller('HomeCtrl', ['myService', '$log', '$scope', '$http', '$rootScope', '$timeout', function (myService, $log, $scope, $http, $rootScope, $timeout) {
        myService.async().then(function (Token_data) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
            $rootScope.FILTER_PAGE_REFERENCE_VALUES_RESET();
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'products/?limit=10'
            }).then(function (data) {
                $scope.popular_products_raw = data.data.results;
                $scope.popular_products = [];
                angular.forEach($scope.popular_products_raw, function (products) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'merchants/' + products.merchant_id + '/'
                    }).then(function (data) {
                        $scope.merchantName = data.name;
                    }, function () {
                    });
                    products['merchant_name'] = $scope.merchantName;
                    $scope.popular_products.push(products);
                });
            }, function () {
            });
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'products/?limit=10'
            }).then(function (data) {
                $scope.featured_products_raw = data.data.results;
                $scope.featured_products = [];
                angular.forEach($scope.featured_products_raw, function (products) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'merchants/' + products.merchant_id + '/'
                    }).then(function (data) {
                        $scope.merchantName = data.name;
                    }, function () {
                    });
                    products['merchant_name'] = $scope.merchantName;
                    $scope.featured_products.push(products);
                });
            }, function () {
            });
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'products/?limit=10'
            }).then(function (data) {
                $scope.new_products_raw = data.data.results;
                $scope.new_products = [];
                angular.forEach($scope.new_products_raw, function (products) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'merchants/' + products.merchant_id + '/'
                    }).then(function (data) {
                        $scope.merchantName = data.name;
                    }, function () {
                    });
                    products['merchant_name'] = $scope.merchantName;
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'categories/' + products.category_id + '/'
                    }).then(function (data) {
                        $scope.categoryName = data.name;
                    }, function () {
                    });
                    products['category_name'] = $scope.categoryName;
                    $scope.new_products.push(products);
                });
            }, function () {
            });
            $http.get('json/top_categories.json?v=' + new Date()).success(function (data) {
                $scope.top_categories = data;
            });
            $http.get('json/recent_reviews.json?v=' + new Date()).success(function (data) {
                $scope.recent_reviews = data;
            });
            $http.get('json/recent_forum.json?v=' + new Date()).success(function (data) {
                $scope.recent_forum = data;
            });
            $http({
                method: 'GET',
                url: 'json/home_compare.json?v=' + new Date()
            }).success(function (response) {
                $scope.home_compare = response;
            });
            $scope.myInterval = 3000;
            $scope.active = 0;
            $scope.noWrapSlides = false;
            $scope.slides = [{
                'id': 126,
                'image': 'img/1.jpg',
                'name': 'Home & Garden',
                'url': 'https://www.pricedrummer.com.gh/category/126/home-&-garden'
            }, {
                'id': 460,
                'image': 'img/2.jpg',
                'name': 'Sports & Outdoors',
                'url': 'https://www.pricedrummer.com.gh/category/460/sports-&-outdoors'
            }, {
                'id': 3,
                'image': 'img/3.jpg',
                'name': 'Camera',
                'url': 'https://www.pricedrummer.com.gh/filter/3/camera'
            }, {
                'id': 471,
                'image': 'img/4.jpg',
                'name': 'Beauty',
                'url': 'https://www.pricedrummer.com.gh/category/471/health-&-beauty'
            }, {
                'id': '',
                'image': 'img/5.jpg',
                'url': 'https://blog.pricedrummer.com.gh/top-10-smartphones-under-500-cedis/'
            }];
            $scope.$on('$viewContentLoaded', function () {
                startHomeSlider();
            });
            angular.element(document).ready(function () {
                $rootScope.PageLoaded = true;
                angular.element(document).find('body').removeClass('ng-hide');
                startHomeSlider();
            });
            $('html,body').animate({
                scrollTop: 0
            }, 200);
        });
    }])
    .filter('spacelessUrl', function () {
        return function (input) {
            if (input) {
                return input.replace(/\s+/g, '-');
            }
        }
    });