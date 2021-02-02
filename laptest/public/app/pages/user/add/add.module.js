(function () {
  'use strict';

  angular.module('RowBoat.pages.user.add', [
  ])
    .config(routeConfig);

  function routeConfig($stateProvider) {
    $stateProvider
      .state('user.add', {
        url: '/add',
        templateUrl: 'app/pages/user/add/add.html',
        controller: 'UserController',
        controllerAs: 'vm',
        title: 'Add User',
        sidebarMeta: {
          order: 0,
        }
      });
  }

})();
