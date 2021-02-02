(function () {
  'use strict';

  angular
    .module('app.user')
    .controller('UserController', UserController);

  UserController.$inject = ['$q', 'userservice', 'logger', 'config'];

  function UserController($q, userservice, logger, config) {
    var vm = this;
    vm.title = 'User';
    vm.smartTablePageSize = config.pageSize;
    vm.smartTablePageSize = 12;

    activate();
    vm.createUser = createUser;
    vm.cancelUser = cancelUser;

    function activate() {
      var promises = [getAllUser()];
      return $q.all(promises).then(function () {
        logger.info('Activated User View');
      });
    }

    function getAllUser() {
      return userservice.getAllUser().then(function (data) {
        vm.users = data;
        return vm.users;
      });
    }

    function createUser(user) {
      if(vm.userForm.$valid)
        return userservice.addUser(user).then(function (data) {
          vm.cancelUser();
        });
    }

    function cancelUser() {
      vm.user = null;
      vm.userForm.$setPristine();
    }

  }
})();
