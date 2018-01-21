(function() {
	'use strict';
	var app = angular.module('produto.detalhe.controllers', []);
    app.controller('ProdutoDetalheCtrl', function($scope, $rootScope, $location, $routeParams, httpEnv) {
    	 //console.log('call ProdutoDetalhe');
 
    	 httpEnv.send("GET", "/produtos/" + $routeParams['id']).then(function(data) {
          	//console.log(data);
          	$scope.detalhe = data.resultSet;
          });
    
    	 $scope.adicionaCarrinho = function(index) {
             //console.log('adicionaCarrinho/'+index);    
             $location.path('/carrinho/' + index);
         }
    });
}());