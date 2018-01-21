(function() {
	'use strict';
	var app = angular.module('carrinho.controllers', []);
    app.controller('CarrinhoCtrl', function($scope, $rootScope, $location, $routeParams, httpEnv, atualizaCarrinho) {
    	 //console.log('call Pedido');
    	if (sessionStorage.getItem('login')) {
    		$rootScope.email = JSON.parse(sessionStorage.getItem('login')).userName;
    	}
    	 /**
    	  * Calcula total da nota
    	  */
    	 var total = function(pedidos) {
    		 $scope.totalNota = 0;
    		 
     		 angular.forEach(pedidos, function(value, key) {    			 
    			 //console.log( "Qtd:" +  pedidos[key].quantidade + "   value:" + pedidos[key].valor);
    			 var totalNota = 0
    			 totalNota = pedidos[key].valor  * pedidos[key].quantidade
    			 $scope.totalNota += totalNota;
     		 });
     		 $rootScope.carrinho = atualizaCarrinho.atualiza();
    	 }
    	 
    	 var load = function(pedidos) { 
    		 httpEnv.send("GET", "/produtos/" + $routeParams['id']).then(function(data) {           
				/**Verifica carrinho*/
				if (localStorage.getItem('carrinho')) {
					//console.log('Existe item')
					if (JSON.parse(localStorage.getItem('carrinho')).length > 0) {
				   		var pedido = JSON.parse(localStorage.getItem('carrinho'));
				   		/**Verifica codigo do produto*/			
				   		var existe = false;
				   		angular.forEach(pedido, function(value, key) {   
			            	 //console.log('Altera Quantidade');
			    			 if ( pedido[key].codigo == data.resultSet.codigo ) {			    				 
			    				 pedido[key].quantidade += data.resultSet.quantidade;
			    				 pedido[key].total = pedido[key].quantidade  * data.resultSet.valor;
			    				 existe = true;
			    				 return false;
			    			 }
				   		});
				   		
				   		if (!existe) {
				   			pedido.push(data.resultSet);
				   		}
				   	    
				   	    localStorage.removeItem('carrinho');
				   	    localStorage.setItem('carrinho', JSON.stringify(pedido))
				}
				} else {
					//console.log('Novo Item');
					//console.log(data);
					var pedidos = [];
					pedidos.push(data.resultSet);
					localStorage.setItem('carrinho', JSON.stringify(pedidos))
				}
				$scope.carrinho = JSON.parse(localStorage.getItem('carrinho'));
				total($scope.carrinho)
				$location.path('/carrinho/0');
    		 });
    	 }
    	 if ($routeParams['id'] > 0) {
    		 load();
    	 } else {
    		 var pedidos = JSON.parse(localStorage.getItem('carrinho'));
    		 $scope.carrinho = pedidos;
    		 total($scope.carrinho)
    	 }
    	 
    	 
    	 /**
    	  * Grava pedido no banco
    	  */
    	 $scope.gravaPedido = function(index) {
             //console.log('listaProdDetalhe/'+index);
    		 if (!sessionStorage.getItem('login')) {
    			 //console.log('Não logado')
    			 $location.path('/login');
    			 return;
    		 }
    		var  pedidos = {
    				data: JSON.parse(localStorage.getItem('carrinho')),
    				user: JSON.parse(sessionStorage.getItem('login'))
    			}
    		 //var pedidos = JSON.parse(localStorage.getItem('carrinho'));
    		 
    		 
    		 httpEnv.send("POST", "/pedidos", pedidos).then(function(data) {
    	         	//console.log(data);
    	         	$scope.produtos = data.resultSet;
    	         	
    	         	if (data.id > 0) {
    	         		localStorage.removeItem('carrinho');
    	         		$rootScope.carrinho = atualizaCarrinho.atualiza()
    	         		$location.path('/pedido');
    	         		return;
    	         	}
    	         });
             
         }
    	 
    	 /**
    	  * Volta para home
    	  */
    	 $scope.voltarLoja = function(index) {
             //console.log('voltarLoja');    
             $location.path('/');
         }
 
    	 /**
    	  * Altera dados do carrinho em relação a quantidade e valores
    	  */
    	 $scope.alteraCarrinho = function(prod, qtd) {
             //console.log('alteraCarrinho/'+prod+'/'+qtd);
             //console.log( JSON.parse(localStorage.getItem('carrinho')));             
             var pedidos = JSON.parse(localStorage.getItem('carrinho'));
             
             angular.forEach(pedidos, function(value, key) {    		     			
    			 if ( pedidos[key].codigo == prod ) {
    				 localStorage.removeItem('carrinho');
    				 //console.log( "Qtd:" +  pedidos[key].Qtd + "   value:" + pedidos[key].Valor);
    				 pedidos[key].quantidade = qtd; 
    				 pedidos[key].total = qtd * pedidos[key].valor; 
    				 localStorage.setItem('carrinho', JSON.stringify(pedidos));
    				 $scope.carrinho = JSON.parse(localStorage.getItem('carrinho'));
    				 total(pedidos);
    			 }
    		});
         }
    	 /**
    	  * Remove itens do carrinho
    	  */
    	 $scope.removerCarrinho = function(prod, qtd) {
             //console.log('removeCarrinho/'+prod+'/'+qtd);
             
             var pedidos = JSON.parse(localStorage.getItem('carrinho'));
             localStorage.removeItem('carrinho');
             $scope.remove = 'false';
             $scope.key = null;
             
             angular.forEach(pedidos, function(value, key) {   
            	 //console.log(pedidos);
    			 if ( pedidos[key].codigo == prod ) {
    				 
    				 pedidos[key].quantidade -= qtd;
    				 
    				 if ( pedidos[key].quantidade < 1) {    					 
    					 $scope.remove = 'true';
    					 $scope.key = key;
    				 } 
    			 }
    		 });
             
			 if ( $scope.remove == 'true') {
				 pedidos.splice($scope.key, 1);
				 //console.log(pedidos);
			 }
			 
			 localStorage.setItem('carrinho', JSON.stringify(pedidos));
			 if (JSON.parse(localStorage.getItem('carrinho')).length == 0) {
				 localStorage.removeItem('carrinho');
			 }
			 
			 $scope.carrinho = JSON.parse(localStorage.getItem('carrinho'));
			 
    		 total(pedidos);
         }
    });
}());