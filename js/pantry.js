'use strict';

var pantryApp = angular.module('pantryApp', ['ngRoute']);

/*****************CONFIG AND RUN*****************/
pantryApp.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/login', {templateUrl: 'partials/login.html', controller: 'loginCtrl'});
  $routeProvider.when('/search', {templateUrl: 'partials/searchclient.html', controller: 'navCtrl'});
  $routeProvider.when('/add', {templateUrl: 'partials/addclient.html'});
  $routeProvider.when('/edit/:id', {templateUrl: 'partials/editclient.html'});
  $routeProvider.otherwise({redirectTo: '/login'});
}]);

pantryApp.run(function($rootScope, $location, loginService){
	var routespermission=['/search', '/add', '/edit'];  //route that require login
	
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
	}
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
}]);

pantryApp.controller('loginCtrl', ['$scope','$location','loginService', function ($scope,$location,loginService) {
	
	$scope.login=function(data){
		loginService.login(data,$scope); //call login service
	};
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
}]);

pantryApp.controller('editController', function ($scope, $http, $routeParams, $location){ 
	var urlEdit = 'php/edit.php';	
	var urlUpdate = 'php/update.php';	
	var urlExport = 'php/export.php';	
	
	var id = "id=" + $routeParams.id;
	$scope.cid = $routeParams.id;
	
	$http({
		method: 'POST',
		url: urlEdit,
		data: id,
		headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
	})
	
	.success(function(data, status) { 	
		if(data.client){ 	

			$scope.orderByField = 'dateOfVisit';
			$scope.reverseSort = true;
			
			$scope.client = data.client;	
			$scope.visits = data.client;
			$scope.volunteers = data.volunteers;
			$scope.client[0].ageGroups = $scope.client[0].ageGroups.split(',');
			
		}
	})
	
	.error(function(data, status) {
		$scope.data = data || "Request failed";
		$scope.status = status;			
	});	

	$scope.update = function(){ 
		
		var thisData = id;
		thisData += "&fname=" + $scope.client[0].fname;
		thisData += "&lname=" + $scope.client[0].lname;
		thisData += "&address=" + $scope.client[0].address;
		thisData += "&city=" + $scope.client[0].city;
		thisData += "&state=" + $scope.client[0].state;
		thisData += "&postalCode=" + $scope.client[0].postalCode;
		thisData += "&phone=" + $scope.client[0].phone;
		thisData += "&email=" + $scope.client[0].email;
		thisData += "&employed=" + $scope.client[0].employed;
		thisData += "&lastDateWorked=" + $scope.client[0].lastDateWorked;
		thisData += "&inHouse=" + $scope.client[0].inHouse;
		thisData += "&howManyMales=" + $scope.client[0].howManyMales;
		thisData += "&howManyFemales=" + $scope.client[0].howManyFemales;
		thisData += "&ageGroups=" + $scope.client[0].ageGroups;
		thisData += "&comments=" + $scope.client[0].comments;
				
		$http({
			method: 'POST',
			url: urlUpdate,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {
			$location.path('/search');
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	
	
	};
	
	$scope.addVisit = function(){ 
		var thisData = id;
		thisData += "&lname=" + $scope.client[0].lname;
		thisData += "&fname=" + $scope.client[0].fname;
		thisData += "&inHouse=" + $scope.client[0].inHouse;
		thisData += "&phone=" + $scope.client[0].phone;
		thisData += "&email=" + $scope.client[0].email;

		thisData += "&dateOfVisit=" + $scope.dateOfVisit;
		thisData += "&program=" + $scope.program;
		thisData += "&numBags=" + $scope.numBags;
		thisData += "&volunteer=" + $scope.volunteer.volunteer;
						
		$http({
			method: 'POST',
			url: urlUpdate,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) { 
			if(data.client){ console.log(data.client);
				$scope.visits = data.client;
			
			}			
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	
	
	};
	/*
	$scope.exportPDF = function(){ 
		var thisData = id;
		thisData += "&from=" + $scope.client[0].from;
		thisData += "&to=" + $scope.client[0].to;
						
		$http({
			method: 'POST',
			url: urlExport,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) { 
		
		
		console.log(data);
		
			if(data.client){
				$scope.visits = data.client;
			
			}
		
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	
	
	};*/	

});

pantryApp.controller('searchController', function ($scope, $http){ 
	var urlSearch = 'php/search.php';	
	var urlDelete = 'php/delete.php';	
	
	$scope.typeOptions = [
		{ name: 'Contains', value: 'contains' }, 
		{ name: 'Starts With', value: 'startsWith' }
    ];
    
    $scope.form = {idType : $scope.typeOptions[0].value, fnameType : $scope.typeOptions[0].value, lnameType : $scope.typeOptions[0].value, 
					addressType : $scope.typeOptions[0].value, phoneType : $scope.typeOptions[0].value};
	
	// create modal on load and hide it
	$( ".dialog-confirm" ).dialog({
	  autoOpen: false,
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Delete": function() { 
		
			var id = $(this).attr('id');
			deleteClient(id);
			$(this).dialog('close');		
		
        },
        Cancel: function() {
			$(this).dialog('close');
        }
      }
    });
	
	$scope.search = function(){ 
		var thisData = "id=" + $scope.clientID;
		thisData += "&idType=" + $scope.form.idType;
		thisData += "&fname=" + $scope.fname;
		thisData += "&fnameType=" + $scope.form.fnameType;
		thisData += "&lname=" + $scope.lname;
		thisData += "&lnameType=" + $scope.form.lnameType;
		thisData += "&address=" + $scope.address;
		thisData += "&addressType=" + $scope.form.addressType;
		thisData += "&phone=" + $scope.phone;
		thisData += "&phoneType=" + $scope.form.phoneType;
		
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
	
	$scope.deleteModal = function(){ 
	
		$(".table tbody").on("click", "tr .btn-danger", function(e){
			$('.dialog-confirm').attr('id', $(this).attr('id'));
			$('.dialog-confirm').dialog('open');
		});

	};
	
	var deleteClient = function (id) {
		
		var thisData = "id=" + id;
				
		$http({
			method: 'POST',
			url: urlDelete,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {			
			var removeByAttr = function(arr, attr, value){
				var i = arr.length;
				while(i--){
				   if( arr[i] 
					   && arr[i].hasOwnProperty(attr) 
					   && (arguments.length > 2 && arr[i][attr] === value ) ){ 

					   arr.splice(i,1);

				   }
				}
				return arr;
			}
			
			removeByAttr($scope.clients, 'id', id.toString());
		})
		
		.error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});	
	};
});

pantryApp.controller('insertController', function ($scope, $http, $location){ 
	var urlInsert = 'php/insert.php';	
	var urlVolunteers = 'php/volunteers.php';
	
	$http.get(urlVolunteers).
	  success(function(data, status, headers, config) {
		$scope.volunteers = data.volunteers;
	  }).
	  error(function(data, status, headers, config) {
			$scope.data = data;
	  });
		
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
		thisData += "&employed=" + $scope.employed;
		thisData += "&lastDateWorked=" + $scope.lastDateWorked;
		thisData += "&inHouse=" + $scope.inHouse;
		thisData += "&howManyMales=" + $scope.howManyMales;
		thisData += "&howManyFemales=" + $scope.howManyFemales;
		thisData += "&ageGroups=" + $scope.ageGroups;
		thisData += "&comments=" + $scope.comments;
		
		thisData += "&dateOfVisit=" + $scope.dateOfVisit;
		thisData += "&program=" + $scope.program;
		thisData += "&numBags=" + $scope.numBags;
		thisData += "&volunteer=" + $scope.volunteer.volunteer;
				
		$http({
			method: 'POST',
			url: urlInsert,
			data: thisData,
			headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
		})
		
		.success(function(data, status) {
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
}]);