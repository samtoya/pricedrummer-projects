'use strict';
angular.module('PxdmSite', ['ngRoute', 'ui.router', 'ncy-angular-breadcrumb', 'angularUtils.directives.dirPagination', 'ui.bootstrap', 'angular-loading-bar', 'ngAnimate', 'angular.filter', 'PxdmSite.home', 'PxdmSite.auth', 'PxdmSite.about', 'PxdmSite.filter', 'PxdmSite.support', 'PxdmSite.compare', 'PxdmSite.catsub', 'PxdmSite.category', 'PxdmSite.seller', 'rzModule', 'ngSanitize']).config(function($stateProvider, $urlRouterProvider, $httpProvider, $locationProvider, $breadcrumbProvider, cfpLoadingBarProvider) {
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
    cfpLoadingBarProvider.includeSpinner = false;
    $locationProvider.html5Mode([{
        "enabled": true,
        "requireBase": false,
        "rewriteLinks": true
    }]);
    $urlRouterProvider.otherwise("/");
}).run(function($http, $rootScope) {}).factory('myService', function($http) {
    var myService = {
        async: function() {
            var promise = $http.get('api/api.php').then(function(response) {
                return response.data;
            });
            return promise;
        }
    };
    return myService;
}).controller('IndexCtrl', ['myService', '$scope', '$http', '$rootScope', '$timeout', '$location', '$state', '$filter', function(myService, $scope, $http, $rootScope, $timeout, $location, $state, $filter) {
    myService.async().then(function(Token_data) {
        $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
        $rootScope.API_ROOT_URL = '//ghapi.pricedrummer.com/api/';
        $rootScope.Breadcrumb = [];
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'categories/?limit=10000',
            cache: true
        }).then(function(data) {
            $rootScope.CATEGORES = data.data.results;
        }, function() {});
        $http({
            method: 'GET',
            url: $rootScope.API_ROOT_URL + 'categories/?level=1&limit=1000',
            cache: true
        }).then(function(data) {
            $scope.mega_categories_raw = data.data.results;
            $scope.mega_categories = [];
            angular.forEach($scope.mega_categories_raw, function(categories1) {
                $http({
                    method: 'GET',
                    url: 'api/catl1n3.php?p=' + categories1.category_id + '&v=' + new Date(),
                    cache: true
                }).then(function(data) {
                    categories1['category_children'] = angular.fromJson(data.data);
                }, function() {});
                $timeout(function() {
                    $scope.mega_categories.push(categories1);
                });
            });
        }, function() {});
        $scope.closeMegaMenu = function() {
            $('#mega').hide("fast");
            $('#nav-icon4').removeClass('open');
        };
        $scope.SrollToTop = function() {
            $('html,body').animate({
                scrollTop: 0
            }, 200);
        }
        $scope.home_search_string = '';
        var _timeout;
        $scope.HomeSearch = function() {
            if (_timeout) {
                $timeout.cancel(_timeout);
            }
            _timeout = $timeout(function() {
                if ($scope.home_search_string.length > 1) {
                    $http({
                        method: 'GET',
                        url: $rootScope.API_ROOT_URL + "productcompare/?search=" + $scope.home_search_string + "&limit=5"
                    }).then(function(response) {
                        $rootScope.search_result = [];
                        $rootScope.search_result = response.data.results;
                        console.log($rootScope.search_result);
                    });
                } else {
                    $rootScope.search_result = [];
                }
                _timeout = null;
            }, 0);
        }
        $scope.ProcessSearch = function(val) {
            $rootScope.search_result = [];
            $scope.home_search_string = val;
        }
        $rootScope.ClearSearchBar = function() {
            $rootScope.Filter_search_string = null;
            $rootScope.search_result = [];
            $scope.home_search_string = "";
        }
        $scope.SubmitHomeSearch = function(form, item) {
            if (typeof item == 'undefined' || item == "" || item == null) {
                var search_input = $("#" + form).find('#home_serch_input').val();
            } else {
                var search_input = item;
            }
            var search_category = $("#" + form).find('#search_category').val();
            $http({
                method: 'GET',
                url: $rootScope.API_ROOT_URL + "productcompare/?search=" + search_input + "&limit=3"
            }).then(function(response) {
                var SampleSearchResult = response.data.results;
                console.log(response.data.results);
                if (SampleSearchResult.length == 1) {
                    var SearchCategory = SampleSearchResult[0].category_id;
                    var SearchCompareProductID = SampleSearchResult[0].id;
                    var SearchSCProductID = SampleSearchResult[0].sc_id;
                    console.log(SearchCategory);
                    var path = "/compare/" + SearchSCProductID + "/" + SearchCompareProductID;
                    $rootScope.search_result = [];
                    $scope.home_search_string = "";
                    $location.url(path);
                } else if (SampleSearchResult.length > 1) {
                    var SearchCategory = SampleSearchResult[0].category_id;
                    console.log(SearchCategory);
                    var path = "/filter/" + SearchCategory + "/Search/" + search_input
                    $rootScope.search_result = [];
                    $scope.home_search_string = "";
                    $location.url(path);
                } else {
                    var path = "/s/" + search_input
                    $rootScope.search_result = [];
                    $scope.home_search_string = "";
                    $location.url(path);
                }
            }, function() {});
        }
        $rootScope.randVersion = new Date();
        $rootScope.FILTER_PAGE_REFERENCE_VALUES_RESET = function() {
            if (typeof $rootScope.Filter_search_string != 'undefined' || $rootScope.Filter_search_string != "" || $rootScope.Filter_search_string != null) {
                $rootScope.Filter_search_string = "&";
            }
            if (typeof $rootScope.currentPage != 'undefined' || $rootScope.currentPage != "" || $rootScope.currentPage != null) {
                $rootScope.currentPage = 1;
            }
            if (typeof $rootScope.Filter_Selected_Array != 'undefined' || $rootScope.Filter_Selected_Array != "" || $rootScope.Filter_Selected_Array != null) {
                $rootScope.Filter_Selected_Array = [];
            }
        };
        $rootScope.FILTER_PAGE_REFERENCE_VALUES_RESET();
        $rootScope.GetBreadcrumCategories = function(CategoryID) {
            $timeout(function() {
                $scope.$watch('CATEGORES', function(n, o) {
                    if (typeof n == "undefined") return;
                    $rootScope.Breadcrumb = [];
                    $rootScope.CurrentCategory = $filter('filter')($rootScope.CATEGORES, function(d) {
                        return d.category_id == CategoryID;
                    });
                    if ($rootScope.CurrentCategory[0].level == 1) {
                        $rootScope.CurrentCategory[0]['url'] = "/category/" + $rootScope.CurrentCategory[0].category_id + "/" + $filter('lowercase')($filter('spacelessUrl')($rootScope.CurrentCategory[0].name));
                        $rootScope.Breadcrumb.push($rootScope.CurrentCategory[0]);
                    }
                    if ($rootScope.CurrentCategory[0].level == 2) {
                        $rootScope.Breadcrumb.push($rootScope.CurrentCategory[0]);
                        var Level1 = $filter('filter')($rootScope.CATEGORES, function(level1) {
                            return level1.category_id == $rootScope.CurrentCategory[0].parent_id;
                        });
                        Level1[0]['url'] = "/category/" + Level1[0].category_id + "/" + $filter('lowercase')($filter('spacelessUrl')(Level1[0].name));
                        $rootScope.Breadcrumb.push(Level1[0]);
                    }
                    if ($rootScope.CurrentCategory[0].level == 3) {
                        $rootScope.Breadcrumb.push($rootScope.CurrentCategory[0]);
                        var Level2 = $filter('filter')($rootScope.CATEGORES, function(level2) {
                            return level2.category_id == $rootScope.CurrentCategory[0].parent_id;
                        });
                        $rootScope.Breadcrumb.push(Level2[0]);
                        var Level1 = $filter('filter')($rootScope.CATEGORES, function(level1) {
                            return level1.category_id == Level2[0].parent_id;
                        });
                        Level1[0]['url'] = "/category/" + Level1[0].category_id + "/" + $filter('lowercase')($filter('spacelessUrl')(Level1[0].name));
                        $rootScope.Breadcrumb.push(Level1[0]);
                    }
                    if ($rootScope.CurrentCategory[0].level == 4) {
                        $rootScope.Breadcrumb.push($rootScope.CurrentCategory[0]);
                        var Level3 = $filter('filter')($rootScope.CATEGORES, function(level3) {
                            return level3.category_id == $rootScope.CurrentCategory[0].parent_id;
                        });
                        $rootScope.Breadcrumb.push(Level3[0]);
                        var Level2 = $filter('filter')($rootScope.CATEGORES, function(level2) {
                            return level2.category_id == Level3[0].parent_id;
                        });
                        $rootScope.Breadcrumb.push(Level2[0]);
                        var Level1 = $filter('filter')($rootScope.CATEGORES, function(level1) {
                            return level1.category_id == Level2[0].parent_id;
                        });
                        Level1[0]['url'] = "/category/" + Level1[0].category_id + "/" + $filter('lowercase')($filter('spacelessUrl')(Level1[0].name));
                        $rootScope.Breadcrumb.push(Level1[0]);
                    }
                });
            }, 100);
        }
        $.getJSON('https://ipinfo.io', function(data) {
            var ip = data['ip'],
                country = data['country'],
                city = data['city'],
                location = data['loc'],
                region = data['region'];

            $rootScope.CurrentUserIP = ip;
            $rootScope.CurrentUserCountry = country;

        });
    });
}]).filter('ReformatID', function() {
    return function(text) {
        return String(text).replace(/ /g, "_").replace(/"/g, "__").replace(/’/g, "VVVV").replace(/:/g, "www").replace(/\//g, "qqq").replace(/\./g, "zzz").replace(/[|]/g, "1111").replace(/[(]/g, "TTT").replace(/[)]/g, "YYY");
    };
}).filter('ReformatHTML', function() {
    return function(text) {
        return String(text).replace(/â€™/g, "'").replace(/â€œ/g, '"').replace(/â€/g, '"');
    };
}).filter('filterMultiple', ['$filter', function($filter) {
    return function(items, keyObj) {
        var filterObj = {
            data: items,
            filteredData: [],
            applyFilter: function(obj, key) {
                var fData = [];
                if (this.filteredData.length == 0)
                    this.filteredData = this.data;
                if (obj) {
                    var fObj = {};
                    if (!angular.isArray(obj)) {
                        fObj[key] = obj;
                        fData = fData.concat($filter('filter')(this.filteredData, fObj));
                    } else if (angular.isArray(obj)) {
                        if (obj.length > 0) {
                            for (var i = 0; i < obj.length; i++) {
                                if (angular.isDefined(obj[i])) {
                                    fObj[key] = obj[i];
                                    fData = fData.concat($filter('filter')(this.filteredData, fObj));
                                }
                            }
                        }
                    }
                    this.filteredData = fData;
                }
            }
        };
        if (keyObj) {
            angular.forEach(keyObj, function(obj, key) {
                filterObj.applyFilter(obj, key);
            });
        }
        return filterObj.filteredData;
    }
}]).filter('filterWithOr', ['$filter', '$rootScope', function($filter, $rootScope) {
    var comparator = function(actual, expected) {
        if (angular.isUndefined(actual)) {
            return false;
        }
        if ((actual === null) || (expected === null)) {
            return actual === expected;
        }
        if ((angular.isObject(expected) && !angular.isArray(expected)) || (angular.isObject(actual) && !hasCustomToString(actual))) {
            return false;
        }
        actual = angular.lowercase('' + actual);
        if (angular.isArray(expected)) {
            var match = false;
            expected.forEach(function(e) {
                e = angular.lowercase('' + e);
                if (actual.indexOf(e) !== -1) {
                    match = true;
                }
            });
            return match;
        } else {
            expected = angular.lowercase('' + expected);
            return actual.indexOf(expected) !== -1;
        }
    };
    return function(campaigns, filters) {
        return $filter('filter')(campaigns, filters, comparator);
    };
}]).filter('spacelessUrl', function() {
    return function(input) {
        if (input) {
            return angular.lowercase(input.replace(/\s+/g, '-').replace(/[, ]+/g, "").replace(/\//g, "-"));
        }
    }
}).filter('uniqueArray', function() {
    return function(items, filterOn) {
        if (filterOn === false) {
            return items;
        }
        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {
            var hashCheck = {},
                newItems = [];
            var extractValueToCompare = function(item) {
                if (angular.isObject(item) && angular.isString(filterOn)) {
                    return item[filterOn];
                } else {
                    return item;
                }
            };
            angular.forEach(items, function(item) {
                var valueToCheck, isDuplicate = false;
                for (var i = 0; i < newItems.length; i++) {
                    if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
                        isDuplicate = true;
                        break;
                    }
                }
                if (!isDuplicate) {
                    newItems.push(item);
                }
            });
            items = newItems;
        }
        return items;
    };
}).filter('join', function() {
    return function(input) {
        return (input || []).join(',');
    };
}).directive('updateTitle', ['$rootScope', '$timeout', function($rootScope, $timeout) {
    return {
        link: function(scope, element) {
            var listener = function(event, toState) {
                var title = 'Default Title';
                if (toState.data && toState.data.pageTitle) title = toState.data.pageTitle;
                $timeout(function() {
                    element.text(title);
                }, 0, false);
            };
            $rootScope.$on('$stateChangeSuccess', listener);
        }
    };
}]);