(function() {
	 'use strict';
    var app = angular.module('myApp.routes', []);
	app.config(function($routeProvider, $httpProvider) {
		$httpProvider.interceptors.push(['$injector', function interceptors($injector) {
	        // Manually injecting dependencies to avoid circular dependency problem
	        return {
	            // preventing duplicate requests
	            'request': function request(config) {
	                var $http = $injector.get('$http'),
	                copiedConfig = angular.copy(config);

	                delete copiedConfig.headers;
	                function configsAreEqual(pendingRequestConfig) {
	                    var copiedPendingRequestConfig = angular.copy(pendingRequestConfig);

	                    delete copiedPendingRequestConfig.headers;

	                    return angular.equals(copiedConfig, copiedPendingRequestConfig);
	                }

	                if ($http.pendingRequests.some(configsAreEqual)) {
	                    debugger;
	                    return null;
	                }

	                return config;
	            }
	        }
	    }
	    ]);
        $routeProvider
        		//.when('/', {templateUrl: 'partials/home/home.html', controller: 'HomeCtrl'})
        		.when('/busca/', {templateUrl: 'partials/produto_lista/produto.lista.html', controller: 'ProdutoListaCtrl'})
        		.when('/lista/:id', {templateUrl: 'partials/produto_lista/produto.lista.html', controller: 'ProdutoListaCtrl'})
        		.when('/detalhe/:id', {templateUrl: 'partials/produto_detalhe/produto.detalhe.html', controller: 'ProdutoDetalheCtrl'})
                .when('/carrinho/:id', {templateUrl: 'partials/carrinho/carrinho.html', controller: 'CarrinhoCtrl'})
                .when('/produto/', {templateUrl: 'partials/produto/produto.html', controller: 'ProdutoList'})
                .when('/pedido/', {templateUrl: 'partials/pedido/pedido.html', controller: 'PedidoList'})
                .when('/pedido_detalhe/:id', {templateUrl: 'partials/pedido_detalhe/pedido_detalhe.html', controller: 'PedidoDetalheCtrl'})
                .when('/login/', {templateUrl: 'partials/login/login.html', controller: 'LoginCtrl'})
                .otherwise({redirectTo: '/'});
    });
}());

