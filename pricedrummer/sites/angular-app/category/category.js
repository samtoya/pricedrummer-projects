angular.module('PxdmSite.category',['ngRoute','ui.router']).config(function($stateProvider,$urlRouterProvider,$locationProvider){$stateProvider.state('/category/:categoryId/:category_name',{url:'/category/:categoryId/:category_name',templateUrl:'category/category.html?v='+new Date(),controller:'CategoryCtrl',data:{pageTitle:'Categories Page'}});$locationProvider.html5Mode(true);}).controller('CategoryCtrl',['myService','$scope','$timeout','$rootScope','$http','$filter','orderByFilter','$stateParams','$state','$timeout','$window',function(myService,$scope,$timeout,$rootScope,$http,$filter,orderBy,$stateParams,$state,$timeout, $window){myService.async().then(function(Token_data){$scope.$on('$viewContentLoaded', function(event){$window.ga('send','pageview',{page: $location.absUrl()});});$http.defaults.headers.common.Authorization='Bearer '+Token_data;$rootScope.FILTER_PAGE_REFERENCE_VALUES_RESET();$scope.urlParams=$stateParams.category_name;var categoryId=$stateParams.categoryId;var categorylev2n3=[];$http({method:'GET',url:'api/catl2n3n4.php?p='+categoryId+'&v='+new Date(),cache:true}).then(function(data){$scope.categorylev2n3=angular.fromJson(data.data)[0];},function(){});$scope.myInterval=6000;$scope.active=0;$scope.noWrapSlides=false;$scope.slides=[{'id':'1','image':'img/slider/002.jpg','thumb':'img/slider/thumb/thumb-002.jpg'},{'id':'2','image':'img/slider/003.jpg','thumb':'img/slider/thumb/thumb-003.jpg'},{'id':'3','image':'img/slider/004.jpg','thumb':'img/slider/thumb/thumb-004.jpg'},{'id':'4','image':'img/slider/005.jpg','thumb':'img/slider/thumb/thumb-005.jpg'},{'id':'5','image':'img/slider/006.jpg','thumb':'img/slider/thumb/thumb-006.jpg'},{'id':'6','image':'img/slider/category1.jpg','thumb':'img/slider/thumb/thumb-006.jpg'},{'id':'7','image':'img/slider/category2.png','thumb':'img/slider/thumb/thumb-006.jpg'},{'id':'8','image':'img/slider/category3.jpg','thumb':'img/slider/thumb/thumb-006.jpg'},{'id':'9','image':'img/slider/category4.jpg','thumb':'img/slider/thumb/thumb-006.jpg'}];$scope.slideshow=[{"id":1,"thumb":"img/slideshow/thumb/small.jpg","image":"img/slideshow/1.jpg"},{"id":2,"thumb":"img/slideshow/thumb/small1.jpg","image":"img/slideshow/2.jpg"},{"id":3,"thumb":"img/slideshow/thumb/small2.jpg","image":"img/slideshow/3.jpg"},{"id":4,"thumb":"img/slideshow/thumb/small3.jpg","image":"img/slideshow/4.jpg"}];$scope.limit=5;$scope.set_cat_class_check=0;$scope.set_cat_class=function(val){$scope.listCompleteVar=false;if(val==3){$scope.set_cat_class_check=0;}
    $scope.set_cat_class_check++;}
    $scope.listCompleteVar=false;$scope.onEnd=function(){$timeout(function(){$('#MyClass1').html($('.class1'));$('#MyClass2').html($('.class2'));$('#MyClass3').html($('.class3'));$scope.listCompleteVar=true;},20);};$rootScope.PageLoaded=true;$timeout(function(){$scope.$watch('CATEGORES',function(n,o){if(typeof n=="undefined")return;$scope.CatLev2n3=$filter('filter')($rootScope.CATEGORES,function(d){return d.category_id==categoryId;});});$scope.CatLev2n3=$filter('filter')($rootScope.CATEGORES,function(d){return d.category_id==categoryId;});},2000);$('html,body').animate({scrollTop:0},200);$rootScope.GetBreadcrumCategories(categoryId);});}]).directive("repeatEnd",function(){return{restrict:"A",link:function(scope,element,attrs){if(scope.$last){scope.$eval(attrs.repeatEnd);}}};}).directive('myDir',function(){return function(scope,element,attrs){if(scope['set_cat_class_check']==1){$(element).addClass('class1');}else if(scope['set_cat_class_check']==2){$(element).addClass('class2');}else if(scope['set_cat_class_check']==3){$(element).addClass('class3');}};});function setLimit(ele){var Items=$(ele).closest('div').siblings("#category_lev_3_list");var ItemBtn=$(ele);if(Items.height()<108){Items.css("max-height","5000px");ItemBtn.text('Show less...');}
else if(Items.height()>105){Items.css("max-height","105px");ItemBtn.text('Show all...');}}