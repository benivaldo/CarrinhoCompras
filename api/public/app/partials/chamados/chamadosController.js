(function() {
	'use strict';
    var app = angular.module('chamadosApp.controllers', []);
    app.controller('ChamadoListCtrl', function($scope, $rootScope, $http, $location, $sce, $templateRequest, $compile, httpEnv) {
        var load = function() {
            console.log('call load()...Chamados');
            $scope.data= {};
            
            httpEnv.send("GET", "/chamados").then(function(data) {
            	//console.log(data);
            	$scope.chamados = data.resultSet;
            });
 
			$scope.sortType     = 'id'; // set the default sort type
			$scope.sortReverse  = false;  // set the default sort order
			$scope.searchChamados   = '';     // set the default search/filter term
        }
        load();
 
        $scope.goBack = function() {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_chamados' ) );
            var html = 'app/partials/chamados/chamado.html';           
      
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.editChamado = function(index) {
            console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_chamados' ) );
            var html = 'app/partials/chamados/edit.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.addNewOne = function(index) {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_chamados' ) );
            var html = 'app/partials/chamados/add.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }

        $scope.deleteChamado = function(index) {
            console.log('call delete');           

            var resp = confirm("Tem certeza que deseja executar essa operação?");
            if (resp == true) {
            	httpEnv.send("DELETE", "/chamados/" + index).then(function(data) {      
               	 alert(data.errorMessage);
                 load();
               });
            } else {
            	console.log('No cancela a operação');  
            }
        }

    });

    app.controller('EditChamadoCtrl', function($scope, $rootScope, $http, $routeParams, $location, httpEnv, $sce, $templateRequest, $compile) {
    	$scope.defaults = {
        	id: '',
        	
        	email: '',
        	titulo: '',
        	observacao: ''
        };
        
    	var load = function(id) {           	
        	 httpEnv.send("GET", "/clientes").then(function(data) {
        		 $scope.clientes  = data.resultSet;
        		 //console.log(data);
             });
        	 
        	 httpEnv.send("GET", "/pedidos").then(function(data) {
        		 $scope.pedidos  = data.resultSet;
             	 //console.log(data);
             });
        
            //console.log('call load()...');
            
            httpEnv.send("GET", "/chamados/" + id).then(function(data) {
            	if (data.resultSet.length > 0 ){
            		//console.log(data.resultSet[0]);
            		$scope.chamados = angular.copy(data.resultSet[0]);
            		$scope.header = $scope.chamados.id;
            	} else {
            		//$scope.chamados = angular.copy($scope.defaults);
            		$scope.header = "Novo chamado";
            		$scope.disableBtn = true;
            	}
       		 	
       		 	$scope.urlInc = "/chamados/0";
       		 	$scope.urlAlter = "/chamados/"+$scope.chamados.id;
       		 	$scope.urlNext = "/nextChamado/next/"+$scope.chamados.id;;
       		 	$scope.urlPrev = "/prevChamado/prev/"+$scope.chamados.id;
            	//console.log(data);
            });
        };        
        load($rootScope.id);
        
        $scope.goNextPrev = function(link) {
        	httpEnv.send("GET", link).then(function(data) {
        		if (data != undefined){
        			console.log(data.id);
        			$rootScope.id = data.id;
        			load(data.id);
        		}
            });
        }
        
        $scope.submit = function() {
        	console.log($scope.chamados);
        	httpEnv.send("PUT", "/chamados/" + $rootScope.id, $scope.chamados).then(function(data) {      
            	 alert(data.errorMessage);
            	 if (data.id > 0) {
            		 load(data.id);
            	 }            	 
            });
        };
    });
    
    app.controller('AddChamadoCtrl', function($scope, $rootScope, $http, $routeParams, $location, httpEnv, $sce, $templateRequest, $compile, $controller) {
    	$scope.defaults = {
        	id: '',
        	cliente_id: null,
        	pedido_id: null,
        	email: '',
        	titulo: '',
        	observacao: ''
        };
    	
    	//var controllerInst = $controller('ChamadoListCtrl');
    	
    	var load = function(id) {           	
        	 httpEnv.send("GET", "/clientes").then(function(data) {
        		 $scope.clientes  = data.resultSet;
        		 //console.log(data);
             });
        	 
        	 httpEnv.send("GET", "/pedidos").then(function(data) {
        		 $scope.pedidos  = data.resultSet;
             	 //console.log(data);
             });
        
            //console.log('call load()...');            
    
    		$scope.chamados = angular.copy($scope.defaults);
    		$scope.header = "";
    		$scope.disableBtn = true;
        };        
        load();
        
        $scope.submit = function() {
        	//console.log($scope.chamados);
        	httpEnv.send("POST", "/chamados", $scope.chamados).then(function(data) {      
            	 alert(data.errorMessage);
            	 
            	 console.log(data.id);
            	 if (data.id > 0) {
            		 $rootScope.editChamado(data.id);
            	 }            	 
            });
        };
     });
}());