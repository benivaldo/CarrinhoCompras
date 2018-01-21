(function() {
	'use strict';
    var app = angular.module('myApp.controllers', []);
    app.controller('mainController', function($scope, $rootScope, $http,  $location, makeTabs, Scopes, $sce, $templateRequest, $compile, $templateCache,$log, $httpParamSerializerJQLike) {
        makeTabs.store('mainController', $scope);
        makeTabs.initTabs('mainController');
        
        $scope.addTab = function (title, view, aba='aba_incial') {         	
        	makeTabs.addTabs('mainController', aba, title, view);
        };
        	
        $scope.removeTab = function (tab) {
        	makeTabs.removeTab('mainController', tab);
        };
    });


}());