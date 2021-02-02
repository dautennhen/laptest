(function () {
  'use strict';

  angular.module('RowBoat.pages.user', [
    'RowBoat.pages.user.list',
    'RowBoat.pages.user.add',
  ])
    .config(routeConfig);

  function routeConfig($stateProvider) {
     $stateProvider.state('user', {
          url: '/user',
          template : '<ui-view></ui-view>',
          abstract: true,
          title: 'User',
          sidebarMeta: {
            icon: 'ion-plus-round',
            order: 100,
          },
        });
  }

})();
