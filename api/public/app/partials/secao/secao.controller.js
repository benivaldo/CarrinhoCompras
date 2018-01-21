(function() {
	'use strict';
    var app = angular.module('secao.controllers', []);
    app.controller('SecaoListCtrl', function($scope, $rootScope, $http, $sce, $templateRequest, $compile, httpEnv) {
        var load = function() {
            console.log('call load()...Secao');
            $scope.data= {};
            
            httpEnv.send("GET", "/secao").then(function(data) {
            	//console.log(data);
            	$scope.secao = data.resultSet;
            });
 
			$scope.sortType     = 'id'; // set the default sort type
			$scope.sortReverse  = false;  // set the default sort order
			$scope.searchSecao   = '';     // set the default search/filter term
        }
        load();
 
        $scope.goBack = function() {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_secao' ) );
            var html = 'app/partials/secao/secao.html';           
      
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.edit = function(index) {
            console.log('call editSecao/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_secao' ) );
            var html = 'app/partials/secao/secao.edit.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.addNewOne = function(index) {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_secao' ) );
            var html = 'app/partials/secao/secao.add.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }

        $scope.delete = function(index) {
            console.log('call delete');           

            var resp = confirm("Tem certeza que deseja executar essa operação?");
            if (resp == true) {
            	httpEnv.send("DELETE", "/secao/" + index).then(function(data) {      
               	 alert(data.errorMessage);
                 load();
               });
            } else {
            	console.log('No cancela a operação');  
            }
        }

    });

    app.controller('EditSecaoCtrl', function($scope, $rootScope, $http, $routeParams, $location, httpEnv, $sce, $templateRequest, $compile) {
    	$scope.defaults = {
        	id: '',        	
        	descricao: '',
        };
        
 
            //console.log('call load()...');
    	var load = function(id) {     
            httpEnv.send("GET", "/secao/" + id).then(function(data) {
            	if (data.resultSet.length > 0 ){
            		//console.log(data.resultSet[0]);
            		$scope.secao = angular.copy(data.resultSet[0]);
            		$scope.header = $scope.secao.id;
            	} else {
            		//$scope.secao = angular.copy($scope.defaults);
            		$scope.header = "Nova Seção";
            		$scope.disableBtn = true;
            	}
       		 	
       		 	$scope.urlInc = "/secao/0";
       		 	$scope.urlAlter = "/secao/"+$scope.secao.id;
       		 	$scope.urlNext = "/nextsecao/next/"+$scope.secao.id;;
       		 	$scope.urlPrev = "/prevsecao/prev/"+$scope.secao.id;
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
        	console.log($scope.secao);
        	httpEnv.send("PUT", "/secao/" + $rootScope.id, $scope.secao).then(function(data) {      
            	 alert(data.errorMessage);
            	 if (data.id > 0) {
            		 load(data.id);
            	 }            	 
            });
        };
    });
    
    app.controller('AddSecaoCtrl', function($scope, $rootScope, $http, $routeParams, $location, httpEnv, $sce, $templateRequest, $compile, $controller) {
    	$scope.defaults = {
        	id: '',
        	descricao: ''
        };
    	
 
        
            //console.log('call load()...');            
    	var load = function(id) {
    		$scope.secao = angular.copy($scope.defaults);
    		$scope.header = "";
    		$scope.disableBtn = true;
        };        
        load();
        
        $scope.submit = function() {
        	//console.log($scope.secao);
        	httpEnv.send("POST", "/secao", $scope.secao).then(function(data) {      
            	 alert(data.errorMessage);
            	 
            	 console.log(data.id);
            	 if (data.id > 0) {
            		 $rootScope.edit(data.id);
            	 }            	 
            });
        };
     });
}());