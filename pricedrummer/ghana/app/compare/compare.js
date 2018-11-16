angular.module('PxdmSite.compare', ['ngRoute', 'ui.router', 'ui.bootstrap', 'ngSanitize']).config(function($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode([{
        "enabled": true,
        "requireBase": false,
        "rewriteLinks": true
    }]);
    $stateProvider.state('/compare/:sc_productId/:productId', {
        url: '/compare/:sc_productId/:compare_productId',
        templateUrl: 'compare/compare.html?v=' + new Date(),
        controller: 'CompareCtrl',
        ncyBreadcrumb: {
            label: 'Compare page'
        },
        data: {
            pageTitle: 'Compare Page'
        }
    })
}).controller('CompareCtrl', ['myService', '$scope', '$rootScope', '$http', '$filter', '$stateParams', '$state', '$uibModal', '$rootScope', 'orderByFilter', '$timeout', function(myService, $scope, $rootScope, $http, $filter, $stateParams, $state, $uibModal, $rootScope, orderBy, $timeout) {
    $scope.keywords = "Welcome to PriceDrummer";
    $('html,body').animate({
        scrollTop: 0
    }, 200);
    myService.async().then(function(Token_data) {
        $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
        if ($stateParams.sc_productId.indexOf(",") >= 0) {
            $scope.SC_ProductId = $stateParams.sc_productId.split(",")[0];
        } else {
            $scope.SC_ProductId = $stateParams.sc_productId;
        }
        $scope.Compare_ProductId = $stateParams.compare_productId;
        $scope.product_count = $stateParams.product_count;
        $scope.product_retailers = [];
        $scope.reverse = true;
        $scope.propertyName = 'price';
        $http.get('json/compare_products.json').success(function(data) {});
        $http.get('json/product_retailers.json').success(function(data) {});
        $http.get('json/product_specs.json').success(function(data) {
            $scope.product_specs = data;
        });
        $http.get('json/similar_products.json').success(function(data) {
            $scope.similar_products = data;
        });
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'sc/' + $scope.SC_ProductId + '/'
        }).then(function(response) {
            $scope.product = response.data;
            $rootScope.GetBreadcrumCategories($scope.product.category_id);
        }, function() {});
        $rootScope.PageLoaded = true;
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'productcompare/' + $scope.Compare_ProductId + '/'
        }).then(function(response) {
            $scope.compare_product = response.data;
            if(response.data.product_id){
                $scope.Merchant_Product_IDs = response.data.product_id.split(",");
            }else{
                $scope.Merchant_Product_IDs = "".split(",");
            }

            if(response.data.retailer_product_id){
                $scope.Retailer_Prod_IDs = response.data.retailer_product_id;
            }else{
                $scope.Retailer_Prod_IDs = '';
            }
            $scope.Retailer_Product_IDs = $scope.Retailer_Prod_IDs.split(",");
            if(response.data.product_id){
                var merchants_products = response.data.product_id;
            }else{
                var merchants_products = '';
            }

            var retailer_products = $scope.Retailer_Prod_IDs;
            var Number_of_Prices = 0;
            ////===========Prepare Merchant Products Count to set prices
            if(merchants_products){
                console.log('There Is A Merchant Product');
                var merchant_product_splited = merchants_products.split(',');
                if(merchant_product_splited.length<2){
                    if(merchant_product_splited[0].trim() != ''){
                        Number_of_Prices=Number_of_Prices+1;
                    }
                }else{
                    Number_of_Prices = Number_of_Prices + merchant_product_splited.length;
                }
            }else{
                console.log('NO Merchant Product');
            }

           // Prepare Retailer Products Count to set prices
            if(retailer_products){
                console.log('There Is A Retailer Product');
                var retailer_product_splited = retailer_products.split(',');
                if(retailer_product_splited.length<2){
                    if(retailer_product_splited[0].trim() != ''){
                        Number_of_Prices=Number_of_Prices+1;
                    }
                }else{
                    Number_of_Prices = Number_of_Prices + retailer_product_splited.length;
                }
            }else{
                // console.log('NO Retailer Product');
            }
            $scope.compare_product['prices_count'] = Number_of_Prices;
            //===========End of count prep ====//


            if($scope.Merchant_Product_IDs.length<2){
                if($scope.Merchant_Product_IDs[0].trim() != ''){
                    //there is one online Merchant
                    angular.forEach($scope.Merchant_Product_IDs, function(Product_id) {
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + 'products/' + Product_id + '/'
                        }).then(function(response) {
                           /* //collect real time price from the merchant site
                            $http({
                                method: 'POST',
                                url: 'api/collect_current_price.php',
                                data: { 'url': response.data.url,
                                    'merchant': response.data.merchant_id},
                                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                            }).then(function(response1) {
                                console.log(response1);
                                console.log('theo');

                            }, function errorCallback(response) {
                                console.log(response);
                                console.log('theo error');
                            });//end of collecting price*/
                            var Prod_Retailer_Info = response.data;
                            Prod_Retailer_Info['rating'] = 0;
                            Prod_Retailer_Info['price'] = parseFloat(response.data.price);
                            Prod_Retailer_Info['is_offline'] = 0;
                            console.log(Prod_Retailer_Info);
                            $scope.product_retailers.push(Prod_Retailer_Info);
                        }, function() {});
                    });
                }
            }else{
                //there is more than one Online Merchant == get their product information
                angular.forEach($scope.Merchant_Product_IDs, function(Product_id) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'products/' + Product_id + '/'
                    }).then(function(response) {
                        /*//collect real time price from the merchant site
                        $http({
                            method: 'POST',
                            url: 'api/collect_current_price.php',
                            params: { 'url': response.data.url,
                                    'merchant': response.data.merchant_id},
                            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).then(function(response1) {
                            console.log(response1);

                        }, function errorCallback(response) {
                            console.log('theo error');
                        });//end of collecting price*/

                        var Prod_Retailer_Info = response.data;
                        Prod_Retailer_Info['rating'] = 0;
                        Prod_Retailer_Info['price'] = parseFloat(response.data.price);
                        Prod_Retailer_Info['is_offline'] = 0;
                        //console.log(Prod_Retailer_Info);
                        $scope.product_retailers.push(Prod_Retailer_Info);
                    }, function() {});
                });
            }



            if($scope.Retailer_Product_IDs.length<2){
                if($scope.Retailer_Product_IDs[0].trim() != ''){
                    //there is one offline Retailer
                    angular.forEach($scope.Retailer_Product_IDs, function(Retailer_Product_id) {
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + 'retailer_products/' + Retailer_Product_id + '/'
                        }).then(function(response) {
                            var Retailer_product_Info = response.data;

                            //Collect the Retailers Personal information
                            $http({
                                method: 'GET',
                                url: $rootScope.API_ROOT_URL + 'retailers/' + Retailer_product_Info.retailer_id + '/'
                            }).then(function(response) {
                                $scope.Retailer_Info = response.data;
                                console.log($scope.Retailer_Info);
                            }, function() {});

                            Retailer_product_Info['rating'] = 0;
                            Retailer_product_Info['price'] = parseFloat(response.data.price);
                            Retailer_product_Info['is_offline'] = 1;
                            Retailer_product_Info['url'] = "/contact_seller/" + $scope.SC_ProductId + "/" + $scope.Compare_ProductId;
                            $scope.product_retailers.push(Retailer_product_Info);
                            console.log(Retailer_product_Info);
                        }, function() {});
                    });
                }
            }else{
                //there is more than one Offline Retailer == get their product information
                angular.forEach($scope.Retailer_Product_IDs, function(Retailer_Product_id) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + 'retailer_products/' + Retailer_Product_id + '/'
                    }).then(function(response) {
                        var Retailer_product_Info = response.data;

                        //Collect the Retailers Personal information
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + 'retailers/' + Retailer_product_Info.retailer_id + '/'
                        }).then(function(response) {
                            $scope.Retailer_Info = response.data;
                            console.log($scope.Retailer_Info);
                        }, function() {});
                        
                        Retailer_product_Info['rating'] = 0;
                        Retailer_product_Info['price'] = parseFloat(response.data.price);
                        Retailer_product_Info['is_offline'] = 1;
                        Retailer_product_Info['url'] = "/contact_seller/" + $scope.SC_ProductId + "/" + $scope.Compare_ProductId;
                        console.log(Retailer_product_Info);
                        $scope.product_retailers.push(Retailer_product_Info);
                    }, function() {});
                });

            }


        }, function() {});
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'scimages/?product_id=' + $scope.SC_ProductId
        }).then(function(response) {
            $scope.product_images = response.data.results;
        }, function() {});
        $scope.getArray = function(num) {
            return new Array(num);
        }
        $scope.ShowProductsImages = function() {
            $rootScope.modalInstance = $uibModal.open({
                templateUrl: 'compare/productImages.html?v=' + new Date(),
                controller: 'CompareModalCtrl',
                animation: false,
                size: 'lg',
                backdrop: 'static',
                scope: $scope,
                keyboard: false,
                resolve: {
                    Images: function() {
                        return $scope.product_images;
                    },
                    retailers: function() {
                        return $scope.product_retailers;
                    },
                    product: function() {
                        return $scope.product;
                    }
                }
            });
        }
        $scope.Close_ShowProductsImages = function(modalInstance) {
            modalInstance.dismiss('cancel');
        }
    });
}]).controller('CompareModalCtrl', function($scope, $rootScope, $sce, $http, $filter, $stateParams, $state, $uibModal, Images, retailers, product) {
    $scope.product_images = Images;
    $scope.product_retailers = retailers;
    console.log($scope.product_retailers);
    $scope.product = product;
    $rootScope.ClearSearchBar();
    angular.forEach($scope.product.sc_detail, function(Spec) {
        if (Spec.detail_name == 'Video Link') {
            $scope.VideoLink = $sce.trustAsHtml(Spec.details_value);
        }
    });
    $scope.getArray = function(num) {
        return new Array(num);
    }
    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 100,
            itemMargin: 5,
            asNavFor: '#slider'
        });
        $('#slider').flexslider({
            animation: "slide",
            controlNav: true,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
}).directive('onFinishRender', function($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function() {
                    scope.$emit(attr.onFinishRender);
                });
            }
        }
    }
});