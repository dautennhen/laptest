(function () {
  'use strict';

  angular.module('RowBoat.pages', [
    'ui.router',
    'RowBoat.pages.dashboard',
    'RowBoat.pages.user',
  ])
    .config(routeConfig);

  function routeConfig($urlRouterProvider, baSidebarServiceProvider) {
    $urlRouterProvider.otherwise('/dashboard');
  }

})();
