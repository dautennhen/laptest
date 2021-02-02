(function () {
  'use strict';

  angular.module('RowBoat.pages.user.list', [
  ])
    .config(routeConfig);

  function routeConfig($stateProvider) {
    $stateProvider
      .state('user.list', {
        url: '/list',
        templateUrl: 'app/pages/user/list/list.html',
        controller: 'ListUserController',
        controllerAs: 'vm',
        title: 'List User',
        sidebarMeta: {
          order: 100,
        }
      });
  }

})();
