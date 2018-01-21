(function() {
	'use strict';
	var app = angular.module('pedido.controllers', []);
    app.controller('PedidoList', function($scope, $rootScope, $location, $routeParams, httpEnv, atualizaCarrinho) {
    	 //console.log('call Pedido');
    	
    	 if (!sessionStorage.getItem('login')) {
			 $location.path('/login');
			 return;
		 }else {
			 $rootScope.email = JSON.parse(sessionStorage.getItem('login')).userName;
		 }
    	 
    	 var load = function(pedidos) { 
    		 httpEnv.send("GET", "/list_pedidos/list/" +JSON.parse(sessionStorage.getItem('login')).userId).then(function(data) {    
    			 //console.log(data.resultSet);
    			 $scope.pedidos = data.resultSet;
    		 });
    	 }

    	 load();
    	 
    	 $scope.pedidoDetalhe = function(index) {
    		 $location.path('/pedido_detalhe/' + index);
    	 }
    });
}());