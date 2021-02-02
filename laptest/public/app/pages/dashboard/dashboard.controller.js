(function () {
    'use strict';

    angular.module('RowBoat.pages.dashboard')
        .controller('DashboardCtrl', DashboardCtrl);

    function DashboardCtrl($scope, $timeout) {
        $scope.treeData = [];
    }
})();