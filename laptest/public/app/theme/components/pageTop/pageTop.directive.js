(function () {
  'use strict';

  angular.module('RowBoat.theme.components')
      .directive('pageTop', pageTop);

  function pageTop() {
    return {
      restrict: 'E',
      templateUrl: 'app/theme/components/pageTop/pageTop.html'
    };
  }

})();