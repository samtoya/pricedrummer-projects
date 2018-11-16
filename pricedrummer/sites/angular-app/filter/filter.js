angular.module('PxdmSite.filter', ['ngRoute', 'ui.router']).config(function($stateProvider, $urlRouterProvider) {
    $stateProvider.state('/filter/:categoryId/:category_name', {
        url: '/filter/:categoryId/:category_name',
        templateUrl: 'filter/filter.html?v=' + new Date(),
        controller: 'FilterCtrl',
        ncyBreadcrumb: {
            label: 'Filter page'
        },
        data: {
            pageTitle: 'Filter Page'
        }
    }).state('/filter/:categoryId/:category_name/:search_param', {
        url: '/filter/:categoryId/:category_name/:search_param',
        templateUrl: 'filter/filter.html?v=' + new Date(),
        controller: 'FilterCtrl',
        ncyBreadcrumb: {
            label: 'Filter page'
        },
        data: {
            pageTitle: 'Filter Page'
        }
    }).state('/s/:search_param', {
        url: '/s/:search_param',
        templateUrl: 'filter/search_result.html?v=' + new Date(),
        controller: 'SearchCtrl',
        ncyBreadcrumb: {
            label: 'Search Results'
        },
        data: {
            pageTitle: 'Search Results'
        }
    })
}).controller('FilterCtrl', ['myService', '$scope', '$rootScope', '$http', '$filter', '$stateParams', '$state', '$timeout', '$location', '$window', function(myService, $scope, $rootScope, $http, $filter, $stateParams, $state, $timeout, $location, $window) {
    $('html,body').animate({
        scrollTop: 0
    }, 200);
    myService.async().then(function(Token_data) {
        $scope.$on('$viewContentLoaded', function(event) {
            $window.ga('send', 'pageview', { page: $location.absUrl() });
        });
        $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
        $scope.categoryId = $stateParams.categoryId;
        $scope.category_name = $stateParams.category_name;
        $scope.url_search = $stateParams.search_param;
        var Page_Site_Url;
        $scope.routto = function(path) {
            $location.path(path).search(Page_Site_Url);
        }
        if ($scope.url_search == "" || $scope.url_search == null) {
            $scope.InputSearchFilter = "";
            $scope.InputSearchFilter_for_api = "";
        } else {
            $scope.InputSearchFilter = $scope.url_search;
            $scope.InputSearchFilter_for_api = "&search=" + $scope.url_search;
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + "categories/?xsearch=" + $scope.url_search
            }).then(function(response) {
                $scope.MatchingCategories = [];
                $scope.RelatedCategories = [];
                // console.log(response.data.results);
                angular.forEach(response.data.results, function(category) {
                    if (category.level > 2 && category.has_product == 1) {
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + "productcompare/?category_id=" + category.category_id + "&limit=2&offset=0&search=" + $scope.url_search
                        }).then(function(response1) {
                            console.log(response1);
                            if (response1.data.results.length > 0) {
                                $scope.MatchingCategories.push(category);
                            }
                        });
                    }
                    if (category.level == 3 && category.has_product == 1) {
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + "categories/?parent_id=" + category.category_id
                        }).then(function(response3) {
                            if (response3.data.results.length > 0) {
                                $scope.RelatedCategories = $scope.RelatedCategories.concat(response3.data.results);
                                // console.log($scope.RelatedCategories);
                            }
                        });
                    }
                });
            });
        }
        $scope.PriceFilter = "";
        $rootScope.loading = true;
        $rootScope.search_result = [];
        $scope.NumOfProducts = 21;
        $scope.compare_products = [];
        $rootScope.PageLoaded = true;
        $scope.total_count = 0;
        if (typeof $rootScope.currentPage == 'undefined' || $rootScope.currentPage == "" || $rootScope.currentPage == null) {
            $rootScope.currentPage = 1;
        }
        if (typeof $rootScope.Filter_search_string == 'undefined' || $rootScope.Filter_search_string == "" || $rootScope.Filter_search_string == null || $rootScope.currentCategory != $scope.categoryId) {
            $rootScope.Filter_search_string = "&";
        }
        if ($rootScope.currentCategory != $scope.categoryId) {
            $rootScope.currentPage = 1;
            $rootScope.Filter_Selected_Array = [];
            $rootScope.Filter_search_string = "&";
        }
        $scope.LoadedUrlParams = 0;
        $scope.getData = function(pageno) {
            $rootScope.loading = true;
            $rootScope.currentPage = pageno;
            $rootScope.currentCategory = $scope.categoryId;
            $('html,body').animate({
                scrollTop: 0
            }, 100);
            $scope.offset = parseInt($scope.NumOfProducts) * (parseInt(pageno) - 1);
            Page_Api_Url = $rootScope.API_ROOT_URL + "productcompare/?category_id=" + $scope.categoryId + "&limit=" + $scope.NumOfProducts + "&page=" + pageno + "&offset=" + $scope.offset + $rootScope.Filter_search_string + $scope.InputSearchFilter_for_api + $scope.PriceFilter;
            // console.log(Page_Api_Url);
            Page_Site_Url = "limit=" + $scope.NumOfProducts + "&page=" + pageno + "&offset=" + $scope.offset + $rootScope.Filter_search_string + $scope.InputSearchFilter_for_api + $scope.PriceFilter;
            $http({
                method: 'GET',
                url: Page_Api_Url.replace(/~/g, ',').replace(/%27/g, "'")
            }).then(function(response) {
                // console.log("MEnnnnnnnnnnnn=>" + Page_Api_Url.replace(/~/g, ','));
                $scope.compare_products = [];
                $scope.compare_result = response.data;
                $scope.compare_products_raw = response.data.results;
                angular.forEach($scope.compare_products_raw, function(product) {
                    var Number_of_Prices = 0;

                    var isMerchantProduct = 0;
                    var isRetailerProduct = 0;
                    var isBothMerchantAndRetailer = 0;

                    var merchants_products = product.product_id;
                    var retailer_products = product.retailer_product_id;

                    //Prepare Merchant Products Count to set prices
                    if(merchants_products){
                        console.log('There Is A Merchant Product');
                        var merchant_product_splited = merchants_products.split(',');
                        if(merchant_product_splited.length<2){
                            if(merchant_product_splited[0].trim() != ''){
                                Number_of_Prices=Number_of_Prices+1;
                                isMerchantProduct=1;
                            }
                        }else{
                            Number_of_Prices = Number_of_Prices + merchant_product_splited.length;
                            isMerchantProduct=1;
                        }

                    }else{
                        console.log('NO Merchant Product');
                    }

                    //Prepare Retailer Products Count to set prices
                    if(retailer_products){
                        console.log('There Is A Retailer Product');
                        var retailer_product_splited = retailer_products.split(',');
                        if(retailer_product_splited.length<2){
                            if(retailer_product_splited[0].trim() != ''){
                                Number_of_Prices=Number_of_Prices+1;
                                isRetailerProduct = 1;
                            }
                        }else{
                            Number_of_Prices = Number_of_Prices + retailer_product_splited.length;
                            isRetailerProduct = 1;
                        }
                    }else{
                        console.log('NO Retailer Product');
                    }

                    //Check and set isBothMerchantAndRetailer to 1 if there is both a merchant and a retailer product
                    if(isMerchantProduct != 0 && isRetailerProduct != 0){
                        isBothMerchantAndRetailer = 1;
                        //empty both isMerchantProduct and isRetailerProduct to prevent the ui from displaying them
                        isMerchantProduct = 0;
                        isRetailerProduct = 0;
                    }

                    product['prices_count'] = Number_of_Prices;
                    product['isMerchantProduct'] = isMerchantProduct;
                    product['isRetailerProduct'] = isRetailerProduct;
                    product['isBothMerchantAndRetailer'] = isBothMerchantAndRetailer;

                    if (Number_of_Prices ==1 && isMerchantProduct==1) {
                        var Product_id = product.product_id.split(",");
                        $http({
                            method: 'GET',
                            url: $rootScope.API_ROOT_URL + 'products/' + Product_id[0] + '/'
                        }).then(function(response) {
                            product['url'] = response.data.url;
                            var compare_url = "/compare/" + product.sc_id + "/" + product.id;
                            product['compare_url'] = compare_url;
                            product['merchant_logo'] = response.data.merchant_id;
                            $scope.compare_products.push(product);
                        }, function() {});
                    } else if(Number_of_Prices ==1 && isRetailerProduct == 1){
                        var compare_url = "/contact_seller/" + product.sc_id + "/" + product.retailer_product_id;
                        product['url'] = compare_url;
                        var compare_url_actual = "/compare/" + product.sc_id + "/" + product.id;
                        product['compare_url'] = compare_url_actual;
                        $scope.compare_products.push(product);
                    } else if(Number_of_Prices > 1 && isBothMerchantAndRetailer==1
                                ||Number_of_Prices > 1 && isMerchantProduct==1
                                ||Number_of_Prices > 1 && isRetailerProduct==1 ){
                        var compare_url = "/compare/" + product.sc_id + "/" + product.id;
                        product['url'] = compare_url;
                        product['compare_url'] = compare_url;
                        $scope.compare_products.push(product);
                    }


                     console.log($scope.compare_products);
                });
                $scope.NumOfPages = Math.ceil($scope.compare_result.count / $scope.NumOfProducts);
                $scope.total_count = $scope.compare_result.count;
                $scope.countForNoProducs = $scope.compare_result.count;
                $rootScope.loading = false;
            }, function() {});
            var path = $location.path();
            $location.path(path).search(Page_Site_Url);
            $window.ga('send', 'pageview', { page: $location.url() });
        };
        $scope.GotoPage = function(pageno) {
            var raw_page_uri = $location.url().split('?')[0];
            var Current_page_url = $location.$$protocol + '://' + $location.$$host + raw_page_uri;

            $scope.offset = parseInt($scope.NumOfProducts) * (parseInt(pageno) - 1);
            var next_url = Current_page_url + "?category_id=" + $scope.categoryId + "&limit=" + $scope.NumOfProducts + "&offset=" + $scope.offset;
            window.location = next_url;
        }

        $rootScope.FILTER_PAGE_CURRENT_URL = $location.$$protocol + '://' + $location.$$host + $location.url();

        $scope.getArray = function(num) {
            return new Array(num);
        }
        $http.get('json/top_Products.json').success(function(data) {
            $scope.top_Products = data;
        });
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'guide/?category_id=' + $scope.categoryId + "&limit=1000"
        }).then(function(response) {
            $scope.buyers_guide = response.data.results;
        }, function() {});
        $scope.ArrNoDupe = function(a) {
            var temp = {};
            for (var i = 0; i < a.length; i++)
                temp[a[i]] = true;
            var r = [];
            for (var k in temp)
                r.push(k);
            return r;
        }
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'categories/' + $scope.categoryId + '/'
        }).then(function(data) {
            $scope.Category_name = data.data.name;
            $scope.filter_specs_raw = data.data.category_detail;
            $scope.filter_specs_load = [];
            angular.forEach($scope.filter_specs_raw, function(filter) {
                var FilterValues = filter.values.split(",");
                FilterValues = FilterValues.filter(function(e) {
                    return e.replace(/(\r\n|\n|\r)/gm, "")
                });
                var Raw_Filter_Values = [];
                var Final_Filter_Values = [];
                angular.forEach(FilterValues, function(filter_value) {
                    if (filter_value.indexOf("|") >= 0) {
                        var FilterValue_new = filter_value.split("|");
                        angular.forEach(FilterValue_new, function(filter_value_d) {
                            if (filter.suggestion.trim() !== "") {
                                var Nval = filter_value_d.replace(/[^0-9.,]/g, '');
                                Raw_Filter_Values.push(Nval.trim());
                            } else {
                                Raw_Filter_Values.push(filter_value_d.trim());
                            }
                        });
                    } else {
                        if (filter.suggestion.trim() !== "") {
                            var Nval = filter_value.replace(/[^0-9.,]/g, '');
                            Raw_Filter_Values.push(Nval.trim());
                        } else {
                            Raw_Filter_Values.push(filter_value.trim());
                        }
                    }
                });
                Final_Filter_Values = $scope.ArrNoDupe(Raw_Filter_Values);
                filter['details_value'] = Final_Filter_Values;
                if ($scope.categoryId == 3) {
                    $scope.CAMERA_DISPLAY_SIZE = ["0 to 1.99", "2 to 2.99", "3 to 3.99", "4 to 4.99", "5 to 5.99", "6 to 6.99", "7 inches & Above"];
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.CAMERA_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.CAMERA_DISPLAY_SIZE;
                    }
                    $scope.CAMERA_MAX_RESOLUTION = ["11 MP & Under", "12 to 23", "24 to 35", "36 MP & Above"];
                    if (filter.detail_code == "MAX_RESOLUTION") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.CAMERA_MAX_RESOLUTION, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" MP & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" MP & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" MP & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" MP & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.CAMERA_MAX_RESOLUTION;
                    }
                    $scope.CAMERA_OPTICAL_ZOOM = ["3.9 & Under", "4 to 9.9", "10 to 19.9", "20 to 49.9", "50 & Above"];
                    if (filter.detail_code == "OPTICAL_ZOOM") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.CAMERA_OPTICAL_ZOOM, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.CAMERA_OPTICAL_ZOOM;
                    }
                }
                if ($scope.categoryId == 39) {
                    $scope.MOBILE_PHONES_DISPLAY_SIZE = [" 3.9 Inches & Under", "4 to 4.4", "4.5 to 4.9", "5.0 to 5.4", " 5.5 Inches & Over"];
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.MOBILE_PHONES_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Over") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Over")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.MOBILE_PHONES_DISPLAY_SIZE;
                    }
                    $scope.MOBILE_PHONES_INTERNAL_STORAGE = ["1GB & Under", "2 to 2.9", "3 to 3.9", "4", "6", "8", "12", "16", "32", "64", "128", "256"];
                    if (filter.detail_code == "INTERNAL_STORAGE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            console.log(filter['details_value']);
                            var filter_Range = {};
                            angular.forEach($scope.MOBILE_PHONES_INTERNAL_STORAGE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf("GB & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split("GB & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf("GB & Over") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split("GB & Over")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.MOBILE_PHONES_INTERNAL_STORAGE;
                    }
                    $scope.MOBILE_PHONES_RAM = ["1GB & Under", "1.1 to 2.9", "3 to 3.9", "4GB & Above"];
                    if (filter.detail_code == "RAM") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.MOBILE_PHONES_RAM, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf("GB & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split("GB & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf("GB & Over") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split("GB & Over")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                                $scope.onEnd();
                            });
                        }, function() {});
                        filter['details_value'] = $scope.MOBILE_PHONES_RAM;
                    }
                }
                $scope.CAMCODERS_DISPLAY_SIZE = ["0 to 1.99", "2 to 2.99", "3 to 3.99", "4 to 4.99", "5 to 5.99", "6 to 6.99", "7 Inches & Above"];
                if ($scope.categoryId == 5) {
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.CAMCODERS_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Over") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.CAMCODERS_DISPLAY_SIZE;
                    }
                    $scope.CAMCODERS_OPTICAL_ZOOM = ["3.9 & Under", "4 to 9.9", "10 to 19.9", "20 to 49.9", "50 & Above"];
                    if (filter.detail_code == "OPTICAL_ZOOM") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.CAMCODERS_OPTICAL_ZOOM, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.CAMCODERS_OPTICAL_ZOOM;
                    }
                }
                if ($scope.categoryId == 19) {
                    $scope.TV_SCREEN_SIZE = ["32 Inches & Under", "33 to 43", "44 to 49", "50 to 59", "60 to 69", "70 Inches & Above"];
                    if (filter.detail_code == "SCREEN_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.TV_SCREEN_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                                $scope.onEnd();
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TV_SCREEN_SIZE;
                    }
                    $scope.TV_HEIGHT = ["32 Inches & Under", "33 to 43", "44 to 49", "50 to 59", "60 Inches & Above"];
                    if (filter.detail_code == "HEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            //console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.TV_HEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TV_HEIGHT;
                    }
                    $scope.TV_WEIGHT = ["10 Kg & Under", "11 to 15", "16 to 20", "21 to 25", "26 to 30", "31 to 40", "41 to 50", "51 Kg & Above"];
                    if (filter.detail_code == "WEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.TV_WEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Kg & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Kg & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TV_WEIGHT;
                    }
                }
                if ($scope.categoryId == 26) {
                    $scope.HOME_THEATER_SYSTEM_WATTS = ["50 Watt & Under", "50 to 150", "151 to 250", "251 to 350", "351 to 450", "451 to 550", "551 to 650", "651 Watt & Above"];
                    if (filter.detail_code == "WATTS") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.HOME_THEATER_SYSTEM_WATTS, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Watt & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Watt & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Watt & Abovee") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Watt & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.HOME_THEATER_SYSTEM_WATTS;
                    }
                    $scope.HOME_THEATER_SYSTEM_CHANNELS = ["0 to 1.9", "2 to 2.9", "3 to 3.9", "4 to 4.9", "5 to 5.9", "6 to 6.9", "7 to 7.9"];
                    if (filter.detail_code == "CHANNELS") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.HOME_THEATER_SYSTEM_CHANNELS, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" CH & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" CH & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" CH & Abovee") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" CH & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.HOME_THEATER_SYSTEM_CHANNELS;
                    }
                    $scope.HOME_THEATER_SYSTEM_WATTS_PER_CHANNEL = ["50 Watt & Under", "50 to 150", "151 to 250", "251 to 350", "351 to 450", "451 to 550", "551 to 650", "651 Watt & Above"];
                    if (filter.detail_code == "WATTS_PER_CHANNEL") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.HOME_THEATER_SYSTEM_WATTS_PER_CHANNEL, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Watt & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Watt & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Watt & Abovee") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Watt & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.HOME_THEATER_SYSTEM_WATTS_PER_CHANNEL;
                    }
                }
                if ($scope.categoryId == 27) {
                    $scope.AUDIO_SPEAKERS_DEPTH = ["0 to 1.99", "2 to 2.99", "3 to 3.99", "4 to 4.99", "5 to 5.99", "6 to 6.99", "7 Inches & Above"];
                    if (filter.detail_code == "DEPTH") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.AUDIO_SPEAKERS_DEPTH, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.AUDIO_SPEAKERS_DEPTH;
                    }
                    $scope.AUDIO_SPEAKERS_HEIGHT = ["0 to 1.99", "2 to 2.99", "3 to 3.99", "4 to 4.99", "5 to 5.99", "6 to 6.99", "7 Inches & Above"];
                    if (filter.detail_code == "HEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.AUDIO_SPEAKERS_HEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.AUDIO_SPEAKERS_HEIGHT;
                    }
                    $scope.AUDIO_SPEAKERS_SPEAKER_WIDTH = ["0 to 1.99", "2 to 2.99", "3 to 3.99", "4 to 4.99", "5 to 5.99", "6 to 6.99", "7 Inches & Above"];
                    if (filter.detail_code == "SPEAKER_WIDTH") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            console.log(angular.fromJson(data.data));
                            var filter_Range = {};
                            angular.forEach($scope.AUDIO_SPEAKERS_SPEAKER_WIDTH, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.AUDIO_SPEAKERS_SPEAKER_WIDTH;
                    }
                }
                if ($scope.categoryId == 107) {
                    $scope.MONITORS_DISPLAY_SIZE = ["19 Inches & Under", "20 to 23", "24 to 29", "30 to 35", "36 Inches & Above"];
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.MONITORS_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.MONITORS_DISPLAY_SIZE;
                    }
                }
                if ($scope.categoryId == 57) {
                    $scope.LAPTOPS_DISPLAY_SIZE = ["11 Inches & Under", "11.1 to 11.9", "12 to 12.9", "13 to 13.9", "14 to 14.9", "15 to 15.9", "16 to 16.9", "17 Inches & Above"];
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.LAPTOPS_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.LAPTOPS_DISPLAY_SIZE;
                    }
                    $scope.LAPTOPS_CPU_SPEED = ["1 GHz & Under", "1.1 to 1.9", "2 to 2.9", "3 to 3.9", "4 GHz & Above"];
                    if (filter.detail_code == "CPU_SPEED") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.LAPTOPS_CPU_SPEED, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" GHz & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" GHz & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" GHz & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" GHz & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.LAPTOPS_CPU_SPEED;
                    }
                    $scope.LAPTOPS_WEIGHT = ["1 pounds & Under", "1.1 to 1.9", "2 to 2.9", "3 to 3.9", "4 to 4.9", "5 pounds & Above"];
                    if (filter.detail_code == "WEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.LAPTOPS_WEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" pounds & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" pounds & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" pounds & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" pounds & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.LAPTOPS_WEIGHT;
                    }
                }
                if ($scope.categoryId == 58) {
                    $scope.TABLETS_DISPLAY_SIZE = ["11 Inches & Under", "11.1 to 11.9", "12 to 12.9", "13 to 13.9", "14 to 14.9", "15 to 15.9", "16 to 16.9", "17 Inches & Above"];
                    if (filter.detail_code == "DISPLAY_SIZE") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.TABLETS_DISPLAY_SIZE, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TABLETS_DISPLAY_SIZE;
                    }
                    $scope.TABLETS_WEIGHT = ["1 Kg & Under", "1.1 to 1.9", "2 to 2.9", "3 to 3.9", "4 to 4.9", "5 Kg & Above", ];
                    if (filter.detail_code == "WEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.TABLETS_WEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Kg & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Kg & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TABLETS_WEIGHT;
                    }
                    $scope.TABLETS_RAM = ["1 GB & Under", "1.1 to 2.9", "3 to 3.9", "4 GB & Above"];
                    if (filter.detail_code == "RAM") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.TABLETS_RAM, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" GB & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" GB & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" GB & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" GB & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.TABLETS_RAM;
                    }
                }
                if ($scope.categoryId == 128) {
                    $scope.FRIDGES_CAPACITY = ["49 L & Under", "50 to 99", "100 to 199", "200 to 299", "300 to 399", "400 to 499", "500 to 599", "600 L & Above"];
                    if (filter.detail_code == "CAPACITY") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.FRIDGES_CAPACITY, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" L & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" L & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" L & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" L & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.FRIDGES_CAPACITY;
                    }
                    $scope.FRIDGES_HEIGHT = ["29.9 Inches & Under", "30 to 39.9", "40 to 49.9", "50 to 59.9", "60 to 69.9", "70 to 79.9", "80 Inches & Above"];
                    if (filter.detail_code == "HEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.FRIDGES_HEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" L & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.FRIDGES_HEIGHT;
                    }
                    $scope.FRIDGES_WIDTH = ["29.9 Inches & Under", "30 to 39.9", "40 to 49.9", "50 to 59.9", "60 to 69.9", "70 to 79.9 ", "80 Inches & Above"];
                    if (filter.detail_code == "WIDTH") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.FRIDGES_WIDTH, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" L & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.FRIDGES_WIDTH;
                    }
                }
                if ($scope.categoryId == 130) {
                    $scope.AC_HORSEPOWER = ["1 HP & Under", "1.1 to 1.9", "2 to 2.9", "3 to 3.9", "4 to 4.9", "5 to 5.9", "6 to 6.9", "7 HP & Above"];
                    if (filter.detail_code == "HORSEPOWER") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.AC_HORSEPOWER, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" HP & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" HP & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" HP & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" HP & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.AC_HORSEPOWER;
                    }
                }
                if ($scope.categoryId == 129) {
                    $scope.WASHERSnDRYERS_CAPACITY = ["4 Kg & Under", "4.1 to 5.9", "6 to 7.9", "8 to 9.9", "10 to 11.9", "12 Kg & Above"];
                    if (filter.detail_code == "CAPACITY") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.WASHERSnDRYERS_CAPACITY, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Kg & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Kg & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Kg & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.WASHERSnDRYERS_CAPACITY;
                    }
                    $scope.WASHERSnDRYERS_HEIGHT = ["29 Inches & Under", "30 to 39.9", "40 to 49.9", "50 to 59.9", "60 to 69.9", "70 to 79.9", "80 Inches & Above"];
                    if (filter.detail_code == "HEIGHT") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.WASHERSnDRYERS_HEIGHT, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.WASHERSnDRYERS_HEIGHT;
                    }
                    $scope.WASHERSnDRYERS_WIDTH = ["29 Inches & Under", "30 to 39.9", "40 to 49.9", "50 to 59.9", "60 to 69.9", "70 to 79.9", "80 Inches & Above"];
                    if (filter.detail_code == "WIDTH") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.WASHERSnDRYERS_WIDTH, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" Inches & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" Inches & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" Inches & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.WASHERSnDRYERS_WIDTH;
                    }
                    $scope.WASHERSnDRYERS_SPIN_SPEED = ["200 RPM & Under", "2 01 to 599", "600 to 1119", "1200 to 1999", "2000 to 3999 ", "4000 to 5999 ", "6000 to 8999", "9000 RPM & Above"];
                    if (filter.detail_code == "SPIN_SPEED") {
                        $http({
                            method: 'GET',
                            url: 'api/filter_distinct_values.php?code=' + filter.detail_code + '&cat_id=' + $scope.categoryId + '&v=' + new Date()
                        }).then(function(data) {
                            var filter_Range = {};
                            angular.forEach($scope.WASHERSnDRYERS_SPIN_SPEED, function(raw_range) {
                                filter_Range[raw_range] = [];
                                angular.forEach(angular.fromJson(data.data), function(value) {
                                    if (raw_range.indexOf(" to ") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" to ")[0]) && parseFloat(value) <= parseFloat(raw_range.split(" to ")[1])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" RPM & Under") >= 0) {
                                        if (parseFloat(value) <= parseFloat(raw_range.split(" RPM & Under")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else if (raw_range.indexOf(" RPM & Above") >= 0) {
                                        if (parseFloat(value) >= parseFloat(raw_range.split(" RPM & Above")[0])) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    } else {
                                        if (parseFloat(value) == parseFloat(raw_range)) {
                                            filter_Range[raw_range].push(value.trim());
                                        }
                                    }
                                });
                            });
                            $timeout(function() {
                                filter['details_actual_value'] = filter_Range;
                            });
                        }, function() {});
                        filter['details_value'] = $scope.WASHERSnDRYERS_SPIN_SPEED;
                    }
                }
                $scope.filter_specs_load.push(filter);
            });
            $timeout(function() {
                $scope.filter_specs = $scope.filter_specs_load;
            });
        }, function() {});
        $scope.filterPageSilderMin = 0;
        $scope.filterPageSilderMax = 0;
        $scope.filterPageSilderMin_floor = 0;
        $scope.filterPageSilderMax_ceil = 0;
        $scope.refreshPriceSlider = function() {
            $timeout(function() {
                $scope.$broadcast('rzSliderForceRender');
                console.log('Me oo');
            });
        };
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + "productcompare/?category_id=" + $scope.categoryId + "&ordering=min_price&limit=1"
        }).then(function(response) {
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            console.log($scope.filterPageSilderMin_floor);
            for (var i=0; i<10; i++) {
                $scope.filterPageSilderMin_floor = response.data.results[0].min_price;
            }

            if (typeof $location.search()['min_price'] != 'undefined') {
                $scope.filterPageSilderMin = parseInt($location.search()['min_price']);
            } else {
                for (var i=0; i<10; i++) {
                    $scope.filterPageSilderMin = response.data.results[0].min_price;
                }
            }


            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + "productcompare/?category_id=" + $scope.categoryId + "&ordering=max_price&limit=1"
            }).then(function(response) {
                for (var i=0; i<10; i++) {
                    $scope.filterPageSilderMax_ceil = response.data.results[0].max_price;
                }
                if (typeof $location.search()['max_price'] != 'undefined') {
                    $scope.filterPageSilderMax = parseInt($location.search()['max_price']);
                } else {
                    for (var i=0; i<10; i++) {
                        $scope.filterPageSilderMax = response.data.results[0].max_price;
                    }
                }
                $scope.ShowPriceSlidePrice = 1;
                $scope.slider = {
                    minValue: $scope.filterPageSilderMin,
                    maxValue: $scope.filterPageSilderMax,
                    options: {
                        floor: $scope.filterPageSilderMin_floor,
                        ceil: $scope.filterPageSilderMax_ceil,
                        step: 1,
                        hidePointerLabels: true,
                        hideLimitLabels: true,
                        translate: function(minValue) {
                            return 'GH¢' + minValue;
                        },
                        onEnd: function(id) {
                            $scope.filterPageSilderMin = $scope.slider.minValue;
                            $scope.filterPageSilderMax = $scope.slider.maxValue;
                            $scope.PriceFilter = "&min_price=" + $scope.slider.minValue + "&max_price=" + $scope.slider.maxValue;
                            $scope.getData($rootScope.currentPage);
                        }
                    }
                };

                $scope.$broadcast('rzSliderForceRender');

                $scope.refreshPriceSlider();
                $scope.refreshPriceSlider();
                $scope.refreshPriceSlider();
            }, function() {});



        }, function() {});

        $scope.priceRange = function(compare_products) {
            return (parseInt(compare_products['price']) >= $scope.filterPageSilderMin && parseInt(compare_products['price']) <= $scope.filterPageSilderMax);
        };
        $scope.sort = function(keyname) {
            $scope.sortKey = keyname;
            $scope.reverse = !$scope.reverse;
        }
        $scope.ToggleFilterSpecs = function(ele_id) {
            $('#' + ele_id).slideToggle(900);
            var headIc = $('#' + ele_id).siblings('.filter-heading').find('#head-icon');
            if (headIc.hasClass('fa-plus-circle')) {
                headIc.removeClass('fa-plus-circle');
                headIc.addClass('fa-minus-circle');
            } else {
                headIc.removeClass('fa-minus-circle');
                headIc.addClass('fa-plus-circle');
            }
        }
        $rootScope.GetBreadcrumCategories($scope.categoryId);
        $scope.mfToggleSpecs = function(element_id) {
            $('#' + element_id + '_mob').slideToggle(900);
            var headIc = $('#' + element_id + '_mob').siblings('.filter-heading').find('#head-icon');
            if (headIc.hasClass('fa-plus-circle')) {
                headIc.removeClass('fa-plus-circle');
                headIc.addClass('fa-minus-circle');
            } else {
                headIc.removeClass('fa-minus-circle');
                headIc.addClass('fa-plus-circle');
            }
        }
        $scope.smToggleSpecs = function(element_id) {
            $('#' + element_id + '_sm').slideToggle(900);
            var headIc = $('#' + element_id + '_sm').siblings('.filter-heading').find('#head-icon');
            if (headIc.hasClass('fa-plus-circle')) {
                headIc.removeClass('fa-plus-circle');
                headIc.addClass('fa-minus-circle');
            } else {
                headIc.removeClass('fa-minus-circle');
                headIc.addClass('fa-plus-circle');
            }
        }
        $scope.removeFromArray = function(arr) {
            var what, a = arguments,
                L = a.length,
                ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) != -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
        $scope.search = {
            id: $scope.Prod_IDs
        };
        if (typeof $rootScope.Filter_Selected_Array == 'undefined' || $rootScope.Filter_Selected_Array == "" || $rootScope.Filter_Selected_Array == null || $rootScope.currentCategory != $scope.categoryId) {
            $rootScope.Filter_Selected_Array = [];
        }
        $scope.closeCanvas = function() {
            var canvas = $('#mf-offcanvas');
            canvas.offcanvas('hide');
        }
        $scope.SetFilterString = function(spec) {
            if ($('#' + spec).is(':checked')) {
                $rootScope.Filter_Selected_Array.push(spec);
                $('#' + spec).attr('checked', 'checked');
            } else {
                $scope.removeFromArray($rootScope.Filter_Selected_Array, spec);
                $('#' + spec).removeAttr('checked');
            }
            $timeout(function() {
                $scope.GenerateSearchFilter();
            }, 10);
        }
        $scope.GenerateSearchFilter = function() {
            $scope.FilterArray_Prep = [];
            angular.forEach($rootScope.Filter_Selected_Array, function(value) {
                var specKeyValueArray = value.split('-');
                var SpecKey = specKeyValueArray[0];
                var SpecValue = specKeyValueArray[1];
                $scope.FilterArray_Prep.push({
                    Spec_title: SpecKey,
                    Spec_value: SpecValue
                });
            });
            var FilterArrayPrepUniqueCheck = {};
            var FilterArrayPrepDistinct = [];
            for (var i in $scope.FilterArray_Prep) {
                if (typeof(FilterArrayPrepUniqueCheck[$scope.FilterArray_Prep[i].Spec_title]) == "undefined") {
                    FilterArrayPrepDistinct.push($scope.FilterArray_Prep[i].Spec_title);
                }
                FilterArrayPrepUniqueCheck[$scope.FilterArray_Prep[i].Spec_title] = 0;
            }
            $scope.search = {
                id: $scope.Prod_IDs
            };
            angular.forEach(FilterArrayPrepDistinct, function(value) {
                FilterSpecsArrayForDistinctSpec = jQuery.grep($scope.FilterArray_Prep, function(Spec, i) {
                    return (Spec.Spec_title == value);
                });
                SpecOptions = function() {
                    var UniqueSpecOptionsCheck = {};
                    var DistinctSpecOption = [];
                    for (var i in FilterSpecsArrayForDistinctSpec) {
                        if (typeof(UniqueSpecOptionsCheck[FilterSpecsArrayForDistinctSpec[i].Spec_value]) == "undefined") {
                            DistinctSpecOption.push(FilterSpecsArrayForDistinctSpec[i].Spec_value);
                        }
                        UniqueSpecOptionsCheck[FilterSpecsArrayForDistinctSpec[i].Spec_value] = 0;
                    }
                    return DistinctSpecOption;
                };
                $scope.search[value] = SpecOptions();
            });
            $rootScope.loading = false;
            var search_string_obj = $scope.search;
            delete search_string_obj["id"];
            $rootScope.Filter_search_string = '&';
            var search_string_obj_length = 0;
            for (var index in search_string_obj) {
                if (search_string_obj.hasOwnProperty(index)) {
                    search_string_obj_length++;
                }
            }
            var search_string_obj_Index = 0;
            angular.forEach(search_string_obj, function(value, key) {
                $rootScope.Filter_search_string += 'f.' + key + '=';
                var value_length = 0;
                for (var index in value) {
                    if (value.hasOwnProperty(index)) {
                        value_length++;
                    }
                }
                var value_Index = 0;
                angular.forEach(value, function(value) {
                    var ValueString = value.replace(/__/g, '"').replace(/VVVV/g, "'").replace(/ /g, '').replace(/1111/g, "|").replace(/zzz/g, ".").replace(/www/g, ":").replace(/qqq/g, "/").replace(/TTT/g, "(").replace(/YYY/g, ")");
                    console.log(ValueString);
                    if (key == "DISPLAY_SIZE" || key == "SCREEN_SIZE" || key == "MAX_RESOLUTION" || key == "OPTICAL_ZOOM" || key == "INTERNAL_STORAGE" || key == "HEIGHT" || key == "WEIGHT" || key == "WATTS" || key == "DEPTH" || key == "WATTS_PER_CHANNEL" || key == "SPEAKER_WIDTH" || key == "CPU_SPEED" || key == "CAPACITY" || key == "HORSEPOWER" || key == "SPIN_SPEED" || key == "RAM") {
                        if (ValueString.indexOf("_to_") >= 0) {
                            var Distinct_Values = ValueString.split("_to_").join('~');
                            console.log(ValueString);
                            console.log(Distinct_Values);
                            ValueString = Distinct_Values
                        }
                    }
                    $rootScope.Filter_search_string += ValueString.replace(/_/g, ' ');
                    if (value_Index != value_length - 1) {
                        $rootScope.Filter_search_string += ','
                    }
                    value_Index++;
                });
                if (search_string_obj_Index != search_string_obj_length - 1) {
                    $rootScope.Filter_search_string += '&';
                }
                search_string_obj_Index++;
            });
            console.log($rootScope.Filter_search_string);
            $scope.compare_products = [];
            $scope.getData($rootScope.currentPage);
        }
        angular.element(document).ready(function() {});
        $scope.onEnd = function() {
            $timeout(function() {
                if (typeof $rootScope.Filter_Selected_Array != 'undefined' || $rootScope.Filter_Selected_Array != "" || $rootScope.Filter_Selected_Array != null) {
                    angular.forEach($rootScope.Filter_Selected_Array, function(value) {
                        var elemrntID = value.replace(/~/g, '_to_');
                        console.log("lll===" + elemrntID);
                        $('#' + elemrntID).attr('checked', true);
                        console.log($('#' + elemrntID));
                    });
                }
            });
        };
        $scope.kk = function() {}
        $scope.urlParams;
        $scope.urlFilterParams;
        $scope.collectUrlParams = function(pageno) {
            var match, pl = /\+/g,
                search = /([^&=]+)=?([^&]*)/g,
                decode = function(s) {
                    return decodeURIComponent(s.replace(pl, " "));
                },
                query = window.location.search.substring(1);
            if (query != "") {
                $scope.urlParams = {};
                $scope.urlFilterParams = {};
                $rootScope.Filter_Selected_Array = [];
                while (match = search.exec(query)) {
                    $scope.urlParams[decode(match[1])] = decode(match[2]);
                    if (decode(match[1]).indexOf("f.") >= 0) {
                        $scope.urlFilterParams[decode(match[1])] = decode(match[2]);
                        var Spec_key = decode(match[1]).substring(decode(match[1]).indexOf("f.") + 2);
                        angular.forEach(decode(match[2]).split(","), function(value, key) {
                            $rootScope.Filter_Selected_Array.push($filter('ReformatID')(Spec_key + '-' + value).replace(/~/g, '_to_'));
                        });
                    }
                }
                console.log($rootScope.Filter_Selected_Array);
                if (typeof $scope.urlParams['min_price'] != 'undefined') {
                    $scope.PriceFilter = "&min_price=" + $scope.urlParams['min_price'] + "&max_price=" + $scope.urlParams['max_price'];
                }
                $timeout(function() {
                    $scope.GenerateSearchFilter();
                }, 10);
            }
        };
        var querycheck = window.location.search.substring(1);
        if ($scope.LoadedUrlParams == 0 && querycheck != "") {
            if (typeof $location.search()['offset'] != 'undefined') {
                $rootScope.currentPage = (parseInt($location.search()['offset']) / $scope.NumOfProducts) + 1;
            }
            $scope.collectUrlParams($rootScope.currentPage);
            $scope.LoadedUrlParams = 1;
        } else {
            $scope.getData($rootScope.currentPage);
        }
        $scope.call = function() {
            console.log($scope.InputSearchFilter);
        }

        //Re-initialize price bar min and max
        $scope.$on('$viewContentLoaded', function(){
            $scope.msg= $route.current.templateUrl + ' is loaded !!';
        });

    });
}]).controller('SearchCtrl', ['myService', '$scope', '$rootScope', '$http', '$filter', '$stateParams', '$state', '$timeout', '$location', function(myService, $scope, $rootScope, $http, $filter, $stateParams, $state, $timeout, $location) {
    $('html,body').animate({
        scrollTop: 0
    }, 200);
    $scope.url_search = $stateParams.search_param;
    myService.async().then(function(Token_data) {
        $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
        $http({
            method: 'GET',
            url: 'json/home_compare.json',
            cache: true
        }).success(function(response) {
            $scope.home_compare = response;
        });
    });
    $rootScope.PageLoaded = true;
}]).directive('myEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.myEnter);
                });
                event.preventDefault();
            }
        });
    };
}).directive("repeatEnd", function() {
    return {
        restrict: "A",
        link: function(scope, element, attrs) {
            if (scope.$last && scope.$parent.$parent.$last) {
                scope.$eval(attrs.repeatEnd);
            }
        }
    };
});
var HasSetFilterBar = 0;
var filterBar = "";
var copiedFilterBar = "";
var filterBarCurrentLocation = "#filterBar";

function getFilterBar() {
    PriceRangeSlider = $('#PriceRangeSlider').html('');
    filterBar = $(filterBarCurrentLocation).html();
    HasSetFilterBar = 1;
    var copiedFilterBar = $('#copiedFilterBar');
    var $PriceSliderDiv = $('<div class="row MyFilterSlider"><div class="col-md-6 no-padding"><span class="minPrice pull-left"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.minValue}}</strong></span> </div> <div class="col-md-6 no-padding"> <span class="maxPrice pull-right"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.maxValue}}</strong></span> </div> </div> <span ng-show="ShowPriceSlidePrice"> <rzslider rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider></span>');
    copiedFilterBar.html(filterBar);
    filterBarCurrentLocation = "#copiedFilterBar";
    $('#filterBar').html('');
    console.log(filterBarCurrentLocation);
    var $target = $("#PriceRangeSlider");
    angular.element(document.body).injector().invoke(function($compile) {
        var $scope = angular.element($target).scope();
        $target.append($compile($PriceSliderDiv)($scope));
        $scope.$apply();
        $scope.refreshPriceSlider();
    });
    var canvas = $('#mf-offcanvas');
    canvas.offcanvas('show');
}

function getFilterBarTablet() {
    PriceRangeSlider = $('#PriceRangeSlider').html('');
    filterBar = $(filterBarCurrentLocation).html();
    HasSetFilterBar = 1;
    var copiedFilterBarTablet = $('#copiedFilterBarTablet');
    copiedFilterBarTablet.html(filterBar);
    filterBarCurrentLocation = "#copiedFilterBarTablet";
    $('#filterBar').html('');
    var $PriceSliderDiv = $('<div class="row MyFilterSlider"><div class="col-md-6 no-padding"><span class="minPrice pull-left"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.minValue}}</strong></span> </div> <div class="col-md-6 no-padding"> <span class="maxPrice pull-right"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.maxValue}}</strong></span> </div> </div> <span ng-show="ShowPriceSlidePrice"> <rzslider rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider></span>');
    var $target = $("#PriceRangeSlider");
    angular.element($target).injector().invoke(function($compile) {
        var $scope = angular.element($target).scope();
        $target.append($compile($PriceSliderDiv)($scope));
        $scope.$apply();
        $scope.refreshPriceSlider();
    });
    var canvas = $('#sm-offcanvas');
    canvas.offcanvas('show');
}

function setFilterBar() {}

function closeCanvas() {
    PriceRangeSlider = $('#PriceRangeSlider').html('');
    var copiedFilterBar = $('#copiedFilterBar').html();
    var filterBar1 = $('#filterBar');
    filterBar1.html(copiedFilterBar);
    filterBarCurrentLocation = "#filterBar";
    HasSetFilterBar = 0;
    $('#copiedFilterBar').html('');
    var $PriceSliderDiv = $('<div class="row MyFilterSlider"><div class="col-md-6 no-padding"><span class="minPrice pull-left"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.minValue}}</strong></span> </div> <div class="col-md-6 no-padding"> <span class="maxPrice pull-right"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.maxValue}}</strong></span> </div> </div> <span ng-show="ShowPriceSlidePrice"> <rzslider rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider></span>');
    var $target = $("#PriceRangeSlider");
    angular.element($target).injector().invoke(function($compile) {
        var $scope = angular.element($target).scope();
        $target.append($compile($PriceSliderDiv)($scope));
        $scope.$apply();
        $scope.refreshPriceSlider();
    });
    var canvas = $('#mf-offcanvas');
    canvas.offcanvas('hide');
}

function closeCanvasTablet() {
    PriceRangeSlider = $('#PriceRangeSlider').html('');
    var copiedFilterBarTablet = $('#copiedFilterBarTablet').html();
    var filterBar1 = $('#filterBar');
    filterBar1.html(copiedFilterBarTablet);
    filterBarCurrentLocation = "#filterBar";
    HasSetFilterBar = 0;
    $('#copiedFilterBarTablet').html('');
    var $PriceSliderDiv = $('<div class="row MyFilterSlider"><div class="col-md-6 no-padding"><span class="minPrice pull-left"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.minValue}}</strong></span> </div> <div class="col-md-6 no-padding"> <span class="maxPrice pull-right"><strong ng-show="ShowPriceSlidePrice">GH¢{{slider.maxValue}}</strong></span> </div> </div> <span ng-show="ShowPriceSlidePrice"> <rzslider rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider></span>');
    var $target = $("#PriceRangeSlider");
    angular.element($target).injector().invoke(function($compile) {
        var $scope = angular.element($target).scope();
        $target.append($compile($PriceSliderDiv)($scope));
        $scope.$apply();
        $scope.refreshPriceSlider();
    });
    var canvas = $('#sm-offcanvas');
    canvas.offcanvas('hide');
}

function hideCanvas() {
    var canvas = $('#mf-offcanvas');
    var canvastab = $('#sm-offcanvas');
    canvas.offcanvas('hide');
    canvastab.offcanvas('hide');
}

function openCanvas() {
    var canvas = $('#mf-offcanvas');
    canvas.offcanvas('show');
}

function ToggleFilterSpecs(ele_id) {
    $('#' + ele_id).slideToggle(900);
    var headIc = $('#' + ele_id).siblings('.filter-heading').find('#head-icon');
    if (headIc.hasClass('fa-plus-circle')) {
        headIc.removeClass('fa-plus-circle');
        headIc.addClass('fa-minus-circle');
    } else {
        headIc.removeClass('fa-minus-circle');
        headIc.addClass('fa-plus-circle');
    }
}