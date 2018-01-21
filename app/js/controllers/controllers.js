(function() {
	'use strict';
    var app = angular.module('myApp.controllers', []);
    app.controller('mainController', function($scope, $rootScope, $http,  $location, httpEnv, atualizaCarrinho) {
    	
    	 var load = function(pedidos) { 
    		 httpEnv.send("GET", "/categorias").then(function(data) {  
    			 //console.log(data);
    			 $scope.menus = data.resultSet;
    			 $rootScope.carrinho=atualizaCarrinho.atualiza()    			 
    		 });
    	 }
    	 
    	 load();
    	
         	
     	$scope.listaProdCategoria = function(index, menu) {
             //console.log('listaProdCategoria/'+index);
             $rootScope.menuId = index;
             $rootScope.menuNome = menu;
             
             $location.path('/lista/' + index);
         }
     	
     	 $rootScope.onSearch = function() {
     		 //console.log($scope.search )
     		 if (! $scope.search.produto){
     			 return;
     		 }
     		 httpEnv.send("GET", "/busca_produtos/search/" + $scope.search.produto).then(function(data) {  
   			 //console.log(data);
   			 $rootScope.produtos = data.resultSet;
   			 $location.path('/busca');
   			 return;		 
   		 });
         }
    });


}());