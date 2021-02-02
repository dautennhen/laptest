(function () {
  'use strict';

  angular
    .module('app.core')
    .factory('userservice', userservice);

  userservice.$inject = ['$http', '$q', 'exception', 'logger', 'config'];
  function userservice($http, $q, exception, logger, config) {
    var service = {
      getAllUser: getAllUser,
      addUser: addUser
    };

    return service;

    function getAllUser() {
      var defer = $q.defer();
      var url = config.url + '/api/user';
      $http({
        method: 'GET',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        url: url
      })
        .then(success)
        .catch(fail);
      return defer.promise;

      function success(response) {
        if(response.data){
          defer.resolve(response.data.data);
        }else{
          defer.resolve(response.data);
        }


      }
      function fail(e) {
        defer.reject(e);
        return exception.catcher('XHR Failed for getPeople')(e);
      }

    }

    function addUser(detail) {
      if(!detail){
        return exception.catcher('data user is fail')();
      }
      var defer = $q.defer();
      var url = config.url + '/api/user';
      $http({
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        url: url,
        data: $.param(detail)
      })
        .then(success)
        .catch(fail);
      return defer.promise;

      function success(response) {
        defer.resolve(response.data);

      }
      function fail(e) {
        defer.reject(e);
        return exception.catcher('XHR Failed for addUser')(e);
      }

    }

  }
})();
