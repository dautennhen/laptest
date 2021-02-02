(function () {
  'use strict';

  angular
    .module('app.level')
    .controller('LevelController', LevelController);

  LevelController.$inject = ['$q', 'userservice', 'logger', 'config'];

  function LevelController($q, userservice, logger, config) {
    var vm = this;
    vm.title = 'Level';
    
  }
})();
