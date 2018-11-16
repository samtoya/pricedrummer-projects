angular.module('PxdmSite.support', ['ngRoute', 'ui.router']).config(function ($stateProvider, $urlRouterProvider) {
        $stateProvider.state('/rules_regulations', {
                url: '/rules_regulations',
                templateUrl: 'support/rules_regulation/rules_regulation.html',
                controller: 'SupportCtrl',
                data: {
                    pageTitle: 'PriceDrummer Rules & Regulations'
                }
            }
        ).state('/for_retailers', {
                url: '/for_retailers',
                templateUrl: 'support/for_retailers/for_retailers.html',
                controller: 'SupportCtrl',
                data: {
                    pageTitle: 'Sell on PriceDrummer Page'
                }
            }
        ).state('/terms_policy', {
                url: '/terms_policy', templateUrl: 'support/terms_policy/terms_policy.html', controller: 'SupportCtrl', data: {
                    pageTitle: 'Terms of Use & Privacy Policy'
                }
            }
        ).state('/cookies', {
                url: '/cookies', templateUrl: 'support/cookies/cookies.html', controller: 'SupportCtrl', data: {
                    pageTitle: 'Cookies Page'
                }
            }
        ).state('/guides', {
                url: '/guides', templateUrl: 'support/guides/guides.html', controller: 'SupportCtrl', data: {
                    pageTitle: 'How to Use PriceDrummer'
                }
            }
        ).state('/faq', {
                url: '/faq', templateUrl: 'support/faq/faq.html', controller: 'SupportCtrl', data: {
                    pageTitle: 'Frequently Asked Questions'
                }
            }
        )
    }
).controller('SupportCtrl', ['myService', '$http', '$rootScope', '$window', function (myService, $http, $rootScope, $window) {
    myService.async().then(function (Token_data) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + Token_data;
            $scope.$on('$viewContentLoaded', function (event) {
                $window.ga('send', 'pageview', {page: $location.absUrl()});
            });
            $rootScope.PageLoaded = true;
            $('html,body').animate({
                    scrollTop: 0
                }
                , 200);
        }
    );
}

])