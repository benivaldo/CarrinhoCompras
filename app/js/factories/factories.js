(function () {
	var app = angular.module('myApp.factories', []);
	
	app.factory('httpEnv', function ($http, config, $q){
		return {			
			send: function(method, link, data, params) {
				var urlApi = config.apiUrl + link;
				var deferred = $q.defer();
				
				console.log(urlApi)
				return $http({
					method : method,
					url : urlApi,
					data: data,
					params: params,
					async: true,
	                cache: false,
		        }).then(function successCallback(response) {
		        	deferred.resolve(response);
		        	return response.data;
				}, function errorCallback(response) {
					//alert(response.data.errorMessage);
					return response.data;
				});
				
			},
		}        
	});
	
	app.factory('atualizaCarrinho', function (){
		return {			
			atualiza: function() {
				//console.log('aualiza')
				 var pedidos = JSON.parse(localStorage.getItem('carrinho'));
	   			 var carrinho = 0;
	                angular.forEach(pedidos, function(value, key) {   
	      				 //console.log('carrinho');
	      				 if (pedidos[key].quantidade > 0) {
	      					 carrinho += pedidos[key].quantidade; 
	      				 }
	      				 //console.log(carrinho);
	                });
	                
	                return carrinho
				},
		}        
	});

}());
