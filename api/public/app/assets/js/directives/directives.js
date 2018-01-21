(function() {
    var app = angular.module('myApp.directives', []);

    app.directive('msg', function() {
        return {
            restrict: 'EA',
            link: function(scope, element, attrs) {
                var key = attrs.key;
                if (attrs.keyExpr) {
                    scope.$watch(attrs.keyExpr, function(value) {
                        key = value;
                        element.text($.i18n.prop(value));
                    });
                }
                scope.$watch('language()', function(value) {
                    element.text($.i18n.prop(key));
                });
            }
        };
    });
    
    app.directive('compileHtml', ['$sce', '$parse', '$compile',
	  function($sce, $parse, $compile) {
	    return {
	      restrict: 'A',
	      compile: function ngBindHtmlCompile(tElement, tAttrs) {
	        var ngBindHtmlGetter = $parse(tAttrs.compileHtml);
	        var ngBindHtmlWatch = $parse(tAttrs.compileHtml, function getStringValue(value) {
	          return (value || '').toString();
	        });
	        $compile.$$addBindingClass(tElement);
	
	        return function ngBindHtmlLink(scope, element, attr) {
	          $compile.$$addBindingInfo(element, attr.compileHtml);
	
	          scope.$watch(ngBindHtmlWatch, function ngBindHtmlWatchAction() {	
	            element.html($sce.trustAsHtml(ngBindHtmlGetter(scope)) || '');
	            $compile(element.contents())(scope);
	          });
	        };
	      }
	    };
	  }
	]); 

    app.directive('dateFormat', ['$filter', function($filter) {
    	 function link(scope, element, attrs) {
    		    var format;
    		    function updateTime() {
    		      element.text(format);
    		    }

    		    scope.$watch(attrs.dateFormat, function(value) {
    		      format = $filter('date')(value, 'dd/MM/yyyy');
    		      updateTime();
    		    });

    		  }

    		  return {
    		    link: link
    		  };
    }]);
    
    app.directive('appVersion', ['version', function(version) {
            return function(scope, elm, attrs) {
                elm.text(version);
            };
        }]);
}());

