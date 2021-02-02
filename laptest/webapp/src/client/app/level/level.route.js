(function() {
  'use strict';

  angular
    .module('app.level')
    .run(appRun);

  appRun.$inject = ['routerHelper'];
  
  function appRun(routerHelper) {
    routerHelper.configureStates(getStates());
  }

  function getStates() {
    return [
      {
        state: 'level',
        config: {
          url: '/level',
          templateUrl: 'app/level/level.html',
          controller: 'LevelController',
          controllerAs: 'vm',
          title: 'Level',
          settings: {
            nav: 2,
            content: '<i class="fa fa-lock"></i> Level'
          }
        }
      }
    ];
  }
})();
