(function () {
    'use strict';

    angular.module('RowBoat.services')
        .factory('userService', userService);

    userService.$inject = ['$http','$q'];

    function userService($http,$q) {
        return {
            addUser: addUser,
            getAllUser: getAllUser,
            getUserById: getUserById
        };


        function addUser(detail) {
            return $http({
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                //url: 'api/1.0/project-manager/item/new/user',
                //url: 'api/1.0/project-manager/item/new/user',
                url:'/api/user',
                data:$.param(detail)
            })
                .then(success)
                .catch(fail);

            function success(response) {
                return response.data;
            }

            function fail(e) {
                return exception.catcher('XHR Failed for getPeople')(e);
            }
        }

        function getAllUser() {
            var defer = $q.defer();
            $http({
                method: 'GET',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                //url: 'api/1.0/project-manager/list/users'
                url:'/api/user'
                    })
                .then(success)
                .catch(fail);
                return defer.promise;

            function success(response) {
                // return response.data;
                defer.resolve(response.data);
                
            }

            function fail(e) {
                // return exception.catcher('XHR Failed for getPeople')(e);
                defer.reject(e);
            }
        }

        function getUserById(idkey) {
            return $http({
                method: 'GET',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                url: 'api/1.0/project-manager/list/users'
            })
                .then(success)
                .catch(fail);

            function success(response) {
                return response.data;
            }

            function fail(e) {
                return exception.catcher('XHR Failed for getPeople')(e);
            }
        }
    }


})();