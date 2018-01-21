(function() {
	'use strict';
	var app = angular.module('produto.lista.controllers', []);
    app.controller('ProdutoListaCtrl', function($scope, $rootScope, $location, httpEnv, $routeParams) {
    	 //console.log('call ProdutoLista');
    	 
    	 if ($rootScope.produtos) {
    		 //console.log('exist');
    		 $scope.produtos = $rootScope.produtos;
    		 $rootScope.produtos = null;
    	 } else {      	 
	    	 httpEnv.send("GET", "/lista_categorias/lista/" + $routeParams['id']).then(function(data) {
	         	//console.log(data);
	         	$scope.produtos = data.resultSet;
	         });
    	 }
    	 
    	 $scope.listaProdDetalhe = function(index) {
            // console.log('listaProdDetalhe/'+index);    
             $location.path('/detalhe/' + index);
         }
 
    });
}());