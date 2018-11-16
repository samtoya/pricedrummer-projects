angular.module('PxdmSite.member', ['ngRoute', 'ui.router'])

    .config(function ($stateProvider, $urlRouterProvider) {
        $stateProvider.state('/member/:member_name', {
            url: '/member/:member_name',
            templateUrl: 'member/member.html?v=' + new Date(),
            controller: 'memberController', data: {
                pageTitle: 'Members- PriceDrummer.com.gh'
            }
        })
    })

    .controller('memberController', ['myService', '$scope', '$rootScope', '$http', '$filter', '$stateParams', '$state', '$timeout', '$location', function(myService, $scope, $rootScope, $http, $filter, $stateParams, $state, $timeout, $location) {
        $('html,body').animate({
            scrollTop: 0
        }, 200);

        myService.async().then(function (Token_data) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;

          $rootScope.PageLoaded = true;
          // $rootScope.MemberPage = true;

            $scope.member_name = $stateParams.member_name.split('-').join(' ').trim();
            console.log($scope.member_name);
            //Collect the Retailers Personal information
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'retailers/?name=' + $scope.member_name
            }).then(function(response) {
                $scope.Retailer_Info = response.data.results[0];
                $scope.Retailer_Product_IDs = $scope.Retailer_Info.id
                console.log($scope.Retailer_Info[0]);

                //Collect the retailer product information
                $http({
                    method: 'GET',
                    url: $rootScope.API_ROOT_URL + 'retailer_products/?retailer_id=' + $scope.Retailer_Product_IDs + '&limit=99999'
                }).then(function(response) {
                    $scope.Retailer_Product_Info = response.data;
                    $scope.Retailer_Products = response.data.results;
                    console.log($scope.Retailer_Products);
                }, function() {});


            })
            }, function() {});

            $scope.scrollup = function () {
                $('html,body').animate({
                    scrollTop: 0
                }, 500);
            }
    }])