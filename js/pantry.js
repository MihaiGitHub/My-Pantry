'use strict';

var pantryApp = angular.module('pantryApp', ['ngRoute']);

/*****************CONFIG AND RUN*****************/
pantryApp.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/login', {templateUrl: 'partials/login.html', controller: 'loginCtrl'});
  $routeProvider.when('/search', {templateUrl: 'partials/searchclient.html', controller: 'navCtrl'});
  $routeProvider.when('/add', {templateUrl: 'partials/addclient.html'});
  $routeProvider.otherwise({redirectTo: '/login'});
}]);

pantryApp.run(function($rootScope, $location, loginService){
	var routespermission=['/search', '/add'];  //route that require login
	
	$rootScope.$on('$routeChangeStart', function(){
		if( routespermission.indexOf($location.path()) !=-1)
		{	
			var connected=loginService.islogged();
			connected.then(function(msg){
				if(!msg.data) $location.path('/login');
			});
		}
	});
	
});
/***********************CONTROLLERS***************/
pantryApp.controller('logoutController', ['$scope','$location','loginService', function($scope,$location,loginService){
	
	$scope.logout=function(){
		$scope.authenticated = false;
		loginService.logout();
		console.log($scope);
	}
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
}])
pantryApp.controller('loginCtrl', ['$scope','$location','loginService', function ($scope,$location,loginService) {
	
	$scope.login=function(data){
		loginService.login(data,$scope); //call login service
	};
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
}]);
/***********************SERVICES***************/
pantryApp.factory('loginService',function($rootScope, $http, $location, sessionService){
	return{
		login:function(data,scope){
			var $promise=$http.post('php/user.php',data); //send data to user.php
			$promise.then(function(msg){
				var uid=msg.data;
				if(uid){
					$rootScope.authenticated = true;
					sessionService.set('uid',uid);
					
					$location.path('/search');
				}	       
				else  {
					scope.msgtxt='incorrect information';
					$location.path('/login');
				}				   
			});
		},
		logout:function(){
			sessionService.destroy('uid');
			$location.path('/login');
		},
		islogged:function(){
			var $checkSessionServer=$http.post('php/check_session.php');
			return $checkSessionServer;
			/*
			if(sessionService.get('user')) return true;
			else return false;
			*/
		}
	}

});
pantryApp.factory('sessionService', ['$http', function($http){
	return{
		set:function(key,value){
			return sessionStorage.setItem(key,value);
		},
		get:function(key){
			return sessionStorage.getItem(key);
		},
		destroy:function(key){
			$http.post('php/destroy_session.php');
			return sessionStorage.removeItem(key);
		}
	};
}])


pantryApp.controller('searchController', function ($scope, $http){ 
	var urlSearch = 'php/search.php';	
	
	$scope.search = function(){ 
		var thisData = "id=" + $scope.clientID;
		thisData += "&fname=" + $scope.fname;
		thisData += "&lname=" + $scope.lname;
				
		$http({
			method: 'POST',
			url: urlSearch,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {
			if(data.clients){ 
				$scope.clients = data.clients;			
			}
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	

	};
});

pantryApp.controller('insertController', function ($scope, $http, $location){ 
	var urlInsert = 'php/insert.php';	
	
	$scope.insert = function(){ 
		var thisData = "id=" + $scope.clientID;
		thisData += "&fname=" + $scope.fname;
		thisData += "&lname=" + $scope.lname;
		thisData += "&address=" + $scope.address;
		thisData += "&city=" + $scope.city;
		thisData += "&state=" + $scope.state;
		thisData += "&postalCode=" + $scope.postalCode;
		thisData += "&phone=" + $scope.phone;
		thisData += "&email=" + $scope.email;
		thisData += "&howManyInHouse=" + $scope.howManyInHouse;
		thisData += "&howManyMales=" + $scope.howManyMales;
		thisData += "&howManyFemales=" + $scope.howManyFemales;
		thisData += "&ageGroups=" + $scope.ageGroups;
		thisData += "&clientNotes=" + $scope.clientNotes;
		
		thisData += "&dateOfVisit=" + $scope.dateOfVisit;
		thisData += "&program=" + $scope.program;
		thisData += "&volunteer=" + $scope.volunteer;
										
		$http({
			method: 'POST',
			url: urlInsert,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {
			/*
			if(data.clients){ 
				$scope.clients = data.clients;			
			}
			*/
			$location.path('/search');
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	

	};
});

pantryApp.controller('navCtrl', ['$scope', '$location', function ($scope, $location) {

    $scope.navClass = function (page) {
        var currentRoute = $location.path().substring(1) || 'search';
        return page === currentRoute ? 'active' : '';
    }; 

	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
}]);