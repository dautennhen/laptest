(function () {
    'use strict';
    angular.module('RowBoat.pages.user.list')
        .controller('ListUserController', ListUserController);

    ListUserController.$inject = ['$scope', '$timeout', 'userService', '$q'];

    function ListUserController($scope, $timeout, userService, $q) {
        var vm = this;
        vm.smartTablePageSize = 10;
        vm.users = [];

        activate();

        function activate() {
            return loadAllUser().then(function () {
            });
        }

        function loadAllUser() {
            return userService.getAllUser()
                .then(function (data) {
                    console.log(data);
                    $timeout(function () {
                        $scope.$apply(function () {
                            vm.users = data;
                            return vm.users;
                        });
                    }, 200);
                });
        }
    }
})();