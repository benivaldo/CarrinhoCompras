(function() {
	'use strict';
	var app = angular.module('login.controllers', []);
    app.controller('LoginCtrl', function($scope, $rootScope, $location, $routeParams, httpEnv, atualizaCarrinho) {
    	$scope.onLogin = function() {
           	httpEnv.send("POST", "/login", $scope.login).then(function(data) {      
            	 //console.log(data.data);
            	 if (data.data.status == 'success') {
            		 sessionStorage.setItem('login', JSON.stringify(data.data.user));
            		 $rootScope.email = data.data.user.userName;
            		 $location.path('/');
            	 }
            });
           	
           	//console.log(JSON.parse(sessionStorage.getItem('login')));
           	
        };
    });
}());