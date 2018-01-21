(function () {
	 'use strict';
  	 var httpHeaders, message, 
  	
  	 app = angular.module('TabApp', [
  	                                 'ui.bootstrap', 
  	                                 "ngRoute", 
  	                                 'ngMaterial', 
  	                                 'myApp.directives',  
  	                                 'myApp.filters', 
  	                                 'myApp.services', 
  	                                 'myApp.factories', 
  	                                 'myApp.controllers', 
  	                                 'myApp.routes', 
  	                                 'ngMessages', 
  	                                 'produto.lista.controllers',
  	                                 'produto.detalhe.controllers',
  	                                 'carrinho.controllers',
  	                                 'pedido.controllers',
  	                                 'pedido.detalhe.controllers',
  	                                 'login.controllers',
  	                                 ])
     
  	 app.constant("config", {
  		 appName: "Carrinho de Compras",
	     appVersion: 1.0,
	     apiUrl: "http://localhost:8400"
	 });

})();