angular.module('PxdmSite.seller', ['ngRoute', 'ui.router'])

    .config(function ($stateProvider, $urlRouterProvider) {
        $stateProvider.state('/contact_seller/:sc_productId/:compare_productId', {
            url: '/contact_seller/:sc_productId/:compare_productId',
            templateUrl: 'contact/contact_seller.html?v=' + new Date(),
            controller: 'ContactSellerCtrl', data: {
                pageTitle: 'Contact Seller - PriceDrummer.com.gh'
            }
        })
    })

    .controller('ContactSellerCtrl', ['myService', '$scope', '$rootScope', '$http', '$filter', '$stateParams', '$state', '$timeout', '$location', function(myService, $scope, $rootScope, $http, $filter, $stateParams, $state, $timeout, $location) {
        $('html,body').animate({
            scrollTop: 0
        }, 200);
        myService.async().then(function (Token_data) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;

            if ($stateParams.sc_productId.indexOf(",") >= 0) {
                $scope.SC_ProductId = $stateParams.sc_productId.split(",")[0];
            } else {
                $scope.SC_ProductId = $stateParams.sc_productId;
            }
            $scope.Compare_ProductId = $stateParams.compare_productId;

            $rootScope.PageLoaded = true;

            //COllect the SC Product related to the selected Item
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'sc/' + $scope.SC_ProductId + '/'
            }).then(function(response) {
                $scope.product = response.data;
                //console.log($scope.product);
                $rootScope.GetBreadcrumCategories($scope.product.category_id);
            }, function() {});

            //Collect the Compare Product Information
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + 'productcompare/' + $scope.Compare_ProductId + '/'
            }).then(function(response) {
                $scope.compare_product = response.data;
                console.log($scope.compare_product);
                $scope.Retailer_Product_IDs = response.data.retailer_product_id.split(",")[0];

                //Collect the retailer product information
                $http({
                    method: 'GET',
                    url: $rootScope.API_ROOT_URL + 'retailer_products/' + $scope.Retailer_Product_IDs + '/'
                }).then(function(response) {
                    $scope.Retailer_Product_Info = response.data;
                    console.log($scope.Retailer_Product_Info);
                    $scope.Retailer_ID = response.data.retailer_id;
                    //Collect the Retailers Personal information
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'retailers/' + $scope.Retailer_ID + '/'
                    }).then(function(response) {
                        $scope.Retailer_Info = response.data;
                        console.log($scope.Retailer_Info);
                    }, function() {});

                    //Collect related product images
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'retailer_product_images/?retailer_product_id=' + $scope.Retailer_ID
                    }).then(function(response) {
                        $scope.product_images = response.data.results;
                        console.log($scope.product_images);
                    }, function() {});

                }, function() {});

            }, function() {});

            $scope.inquiry={};
            $scope.Submit_retailer_email_form = function(data) {
                console.log(data);
                $scope.inquiry.email_to = $scope.Retailer_Info.email;
                //prepare post Values
                $scope.toparams = function ObjecttoParams(obj) {
                    var p = [];
                    for (var key in obj) {
                        p.push(key + '=' + encodeURIComponent(obj[key]));
                    }
                    return p.join('&');
                };
                //make the http post request
                $http({
                    method: 'POST',
                    url: 'contact/send_mail_to_retailer.php',
                    data:  $scope.toparams(data),
                    headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response1) {
                    $scope.inquiry={};
                    $('#retailer_email_form').trigger("reset");
                    console.log(response1);
                    swal("Thank You!", "Your Message Will Be Delevered!", "success")

                }, function errorCallback(response) {
                    console.log('theo error');
                });
            }



        })
    }])