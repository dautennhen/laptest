(function () {
    'use strict';
    angular.module('RowBoat.pages.user.add')
        .controller('UserController', UserController);

    UserController.$inject = ['$scope', '$timeout', 'userService'];

    function UserController($scope, $timeout, userService) {
        var vm = this;
        
        $scope.createUser = function (user) {
            userService.addUser(user);
        }

        $scope.cancelUser = function () {
            vm.user = {};
            vm.user.username = undefined;
            vm.userForm.$setPristine();
        }
    }
})();