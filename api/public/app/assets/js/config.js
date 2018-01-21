(function() {

  'use strict';

  angular
    .module('tokenAuthApp.config', [])
    .config(appConfig)
    .run(routeStart);

  function appConfig($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/partials/home/home.view.html',
        controller: 'mainController',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: false
        }
      })
      .when('/auth', {
        templateUrl: 'app/partials/auth/auth.login.view.html',
        controller: 'authLoginController',
        controllerAs: 'authLoginCtrl',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: true
        }
      })
      .when('/register', {
        templateUrl: 'app/partials/auth/auth.register.view.html',
        controller: 'authRegisterController',
        controllerAs: 'authRegisterCtrl',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: true
        }
      })
      .when('/status', {
        templateUrl: 'app/partials/auth/auth.status.view.html',
        controller: 'authStatusController',
        controllerAs: 'authStatusCtrl',
        restrictions: {
          ensureAuthenticated: true,
          loginRedirect: false
        }
      })
      .otherwise({
        redirectTo: '/auth'
      });
  }

  function routeStart($rootScope, $location, $route) {
	  $rootScope.$on('$routeChangeStart', function (event, next, current) {
		  console.log(localStorage.getItem('token'))
		  if (next.restrictions !== undefined) {
			  if (next.restrictions.ensureAuthenticated) {
				  if (!localStorage.getItem('token')) {
					  console.log('not logged')
					  $location.path('/auth');
				  }
		      }
		      if (next.restrictions.loginRedirect) {
		    	  if (localStorage.getItem('token')) {
		    		  console.log('Logged')
		    		  console.log(localStorage.getItem('token'))
		    		  $location.path('/auth');
		    	  }
		      }
		  } else {
			  $location.path('/auth');
		  }
	  });
  }

})();
