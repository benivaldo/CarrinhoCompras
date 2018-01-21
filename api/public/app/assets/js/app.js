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
  	                               'secao.controllers', 
  	                                 'chamadosApp.controllers', 
  	                                 'myApp.routes', 
  	                                 'angularUtils.directives.dirPagination',
  	                                 'ngMessages', 
  	                                 'tokenAuthApp.config', 
  	                                 'tokenAuthApp.components.auth',
  	                                
  	                                 ])
     
     app.config(function($mdThemingProvider) {

		  // Extend the red theme with a different color and make the contrast color black instead of white.
		  // For example: raised button text will be black instead of white.
		  var neonRedMap = $mdThemingProvider.extendPalette('red', {
		    '500': 'ffffff',
		    'contrastDefaultColor': 'dark'
		  });
		
		  // Register the new color palette map with the name <code>neonRed</code>
		  $mdThemingProvider.definePalette('neonRed', neonRedMap);
		  $mdThemingProvider.definePalette('amazingPaletteName', {
		    '50': '89253e',
		    '100': 'FFEBEE',
		    '200': 'EF9A9A',
		    '300': 'E57373',
		    '400': 'EF5350',
		    '500': 'F44336',
		    '600': 'E53935',
		    '700': 'D32F2F',
		    '800': 'C62828',
		    '900': 'b71c1c',
		    'A100': 'ff8a80',
		    'A200': 'ff5252',
		    'A400': 'ff1744',
		    'A700': 'd50000',
		    'contrastDefaultColor': 'light',    // whether, by default, text (contrast)
		                                        // on this palette should be dark or light

		    'contrastDarkColors': ['50', '100', //hues which contrast should be 'dark' by default
		     '200', '300', '400', 'A100'],
		    'contrastLightColors': undefined    // could also specify this if default was 'dark'
		  });
		
		  // Use that theme for the primary intentions
		  $mdThemingProvider.theme('default')
		    .primaryPalette('neonRed')
		    .accentPalette('green')
		    .backgroundPalette('amazingPaletteName');
		  
		  //$mdThemingProvider.disableTheming();
		});
		
		/*app.run(['$templateCache', function ( $templateCache ) {
		    $templateCache.removeAll(); 
		 }]);*/
})();