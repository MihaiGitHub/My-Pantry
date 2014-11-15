'use strict';

var pantryApp = angular.module('pantryApp', ['ngRoute']);

pantryApp.config(function ($routeProvider){ 
	$routeProvider
		.when('/search',    
			{	
				controller: 'navCtrl',
				templateUrl: 'partials/searchclient.html'
			})
		.when('/add',
			{
				controller: 'navCtrl',
				templateUrl: 'partials/addclient.html'
			})
		.otherwise({ redirectTo: '/search' });  
});

pantryApp.controller('searchController', function ($scope, $http){ 
	var urlSearch = 'php/search.php';	
	
	$scope.search = function(){ 
		var id = "id=" + $scope.clientID;
				
		$http({
			method: 'POST',
			url: urlSearch,
			data: id,
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
						
		$http({
			method: 'POST',
			url: urlInsert,
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

pantryApp.controller('navCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.navClass = function (page) {
        var currentRoute = $location.path().substring(1) || 'search';
        return page === currentRoute ? 'active' : '';
    };  
}]);