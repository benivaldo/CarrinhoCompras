(function() {

  'use strict';

  angular
    .module('tokenAuthApp.components.auth', [])
    .controller('authLoginController', authLoginController)
    .controller('authRegisterController', authRegisterController)
    .controller('authStatusController', authStatusController);

  authLoginController.$inject = ['$location', 'authService'];
  authRegisterController.$inject = ['$location', 'authService'];
  authStatusController.$inject = ['$location', 'authService'];

  function authLoginController($location, authService) {
    /*jshint validthis: true */
    const vm = this;
    vm.user = {};
    vm.onLogin = function() {
      authService.login(vm.user)
      .then((user) => {
    	console.log('authService')
      	console.log(user.data.data.token)
        localStorage.setItem('token', user.data.data.jwt);
        $location.path('/status');
      })
      .catch((err) => {
    	  console.log('Status');
        console.log(err.status);
      });
    };
  }

  function authRegisterController($location, authService) {
    /*jshint validthis: true */
    const vm = this;
    vm.user = {};
    vm.onRegister = function() {
      authService.register(vm.user)
      .then((user) => {
        localStorage.setItem('token', user.data.token);
        $location.path('/status');
      })
      .catch((err) => {
        console.log(err);
      });
    };
  }

  function authStatusController($location, authService) {
    /*jshint validthis: true */
    const vm = this;
    vm.isLoggedIn = false;
    const token = localStorage.getItem('token');
    if (token) {
      authService.ensureAuthenticated(token)
      .then((user) => {
    	  console.log(user.data.data.status);
        if (user.data.data.status === 'success'){
        	vm.isLoggedIn = true;
        	$location.path('/');
        } else {
        	vm.isLoggedIn = false;
        }
        
      })
      .catch((err) => {
        console.log(err);
      });
    }
  }

})();
