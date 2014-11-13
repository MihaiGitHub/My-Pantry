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
		
		console.log('clientID: ', id);
		
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
			console.log(data);
			/*
			$scope.status = status;
			$scope.data = data;
			
			//console.log('status ', $scope.status, 'data ', $scope.data);
			//$scope.result = data; // Show result from server in our <pre></pre> element
			*/
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	

	};
});
/*
pantryApp.controller('mainController', function ($scope, $http){ 
	var urlSelect = 'php/select.php';
	var urlSearch = 'php/search.php';	

	$scope.select = function(){
		$http.get(urlSelect)
			.success(function(data){
			
				if(data.clients){ 
					$scope.clients = data.clients;			
				}
								
			})
			.error(function(data, status, headers, config){
				throw new Error('Something went wrong with selecting records');
			})
	};
//	$scope.select();
	$scope.search = function(){ 
		var id = "id=" + $scope.client;
		
		console.log('clientID: ', id);
		
		$http({
			method: 'POST',
			url: urlSearch,
			data: id,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {
			$scope.status = status;
			$scope.data = data;
			console.log($scope);
			//console.log('status ', $scope.status, 'data ', $scope.data);
			//$scope.result = data; // Show result from server in our <pre></pre> element
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	
	

	};

});
*/
pantryApp.controller('navCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.navClass = function (page) {
        var currentRoute = $location.path().substring(1) || 'search';
        return page === currentRoute ? 'active' : '';
    };  
}]);