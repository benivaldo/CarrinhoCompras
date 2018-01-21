(function () {
	var app = angular.module('myApp.factories', []);
	
    /**
     * Função para armazenar e retornar o objeto $scope
     */
	app.factory('Scopes', function ($rootScope) {
	    var mem = {};
	    
	    return {
	        store: function (key, value) {
	            mem[key] = value;
	        },
	        get: function (key) {
	            return mem[key];
	        }
	    };
	});
	
	app.factory('httpEnv', function ($rootScope, $http, $templateCache){
		return {			
			send: function(method, link, data = null, params = null) {
				return $http({
					method : method,
					url : link,
					data: data,
					params: params,
		        }).then(function successCallback(response) {
		        	return response.data;
				}, function errorCallback(response) {
					alert(response.statusText);
				});
			},
		}        
	});
	
	/**
	 * Função para criar tabs dinamicas
	 */
	app.factory('makeTabs', function ($rootScope, $compile, $sce, $templateRequest, $filter) {
        var mem = {};
	    
	    return {
	        store: function (key, value) {
	            mem[key] = value;
	        },
	        
	        get: function (key) {
	            return mem[key];
	        },
	        
	        initTabs: function (ctrl) {
	        	var scopeCtrl1 = this.get(ctrl);
	        	
	        	var tabs = [
	            	{ title: 'Home', content: "<div class=\"div-tab-content\" data-abas=\"aba_inicial\">Zend Framework 3 e AngularJs</div>"},

                ],
                
                selected = null,
                previous = null;
	        	scopeCtrl1.tabs = tabs;
        		
	        	scopeCtrl1.selectedIndex = 0;
	        	scopeCtrl1.$watch('selectedIndex', function(current, old){
	        		previous = selected;
	        		selected = tabs[current];	        		
		           /* if ( old + 1 && (old != current)) console.log('Goodbye ' + previous.title + '!');
		            if ( current + 1 )                console.log('Hello ' + selected.title + '!');*/
	            });
	        },
	        
	        addTabs: function (ctrl, aba, title, html) {
	        	var scopeCtrl = this.get(ctrl);	        	
	        	var templateUrl = $sce.getTrustedResourceUrl(html);
	        	var index = scopeCtrl.tabs.find(function(item){return item.title === title});	        	
	        	//console.log(scopeCtrl.tabs.indexOf(index));
	        	
	        	if (scopeCtrl.tabs.indexOf(index) >= 0) {
        			scopeCtrl.selectedIndex = scopeCtrl.tabs.indexOf(index);
					return false;
	        	}
	        	/*var teste = $filter('filter')(scopeCtrl.tabs, {title: title}, true)[0];
	        	if (teste != undefined) {
	        		if (Object.keys(teste).length > 0) {
	        			scopeCtrl.selectedIndex = 0;
						return false;
					}
	        	}*/

	        	$templateRequest(templateUrl).then(function(template) {
	  	        		view = "<div class=\"div-tab-content\" data-abas=\""+aba+"\" id=\""+aba+"\" data-name =\""+title+"\">"+template+"</div>";
	  	        		scopeCtrl.tabs.push({ title: title, content: view, disabled: false});
	            });
	        },
	        
	        removeTab: function (ctrl, tab) {
	        	var scopeCtrl = this.get(ctrl);
            	//console.log(scopeCtrl.tabs.length )
              if (scopeCtrl.tabs.length <= 1){
            	  return false;
              }
              
              var index = scopeCtrl.tabs.indexOf(tab);
              scopeCtrl.tabs.splice(index, 1);
            },
	    }; 
    });

}());
