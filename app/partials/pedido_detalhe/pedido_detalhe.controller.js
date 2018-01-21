(function() {
	'use strict';
	var app = angular.module('pedido.detalhe.controllers', []);
    app.controller('PedidoDetalheCtrl', function($scope, $rootScope, $location, $routeParams, httpEnv, atualizaCarrinho) {
    	 //console.log('call Pedido');
    	$rootScope.email = JSON.parse(sessionStorage.getItem('login')).userName;
    	$scope.pedido = $routeParams['id'];
    	 var load = function() { 
    		 httpEnv.send("GET", "/pedidos/" + $routeParams['id']).then(function(data) {  
    			 //console.log(data.resultSet);
    			 $scope.dadosPedido = data.resultSet;
    		 });
    		 
    		 httpEnv.send("GET", "/pedido_itens/" + $routeParams['id']).then(function(data) {  
    			 //console.log(data.resultSet);
    			 $scope.pedidos = data.resultSet;
    		 });
    	 }
    	 
    	 load();
    });
}());