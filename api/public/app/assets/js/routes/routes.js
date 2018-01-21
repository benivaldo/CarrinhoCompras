(function() {
	 'use strict';
    var app = angular.module('myApp.routes', []);
	app.config(function($routeProvider, $httpProvider) {
        $routeProvider
                .when('/albums', {templateUrl: 'partials/albums.html', controller: 'AlbumListCtrl'})
                .when('/new', {templateUrl: 'partials/new.html', controller: 'NewAlbumCtrl'})
                .when('/edit/:id', {templateUrl: 'partials/chamados/edit.html', controller: 'EditChamadoCtrl'})
                .when('/album/:id', {templateUrl: 'partials/album.html', controller: 'AlbumCtrl'})
                .otherwise({redirectTo: '/'});
//        $httpProvider.defaults.useXDomain = true;
//        delete $httpProvider.defaults.headers.common["X-Requested-With"];
    });


}());

