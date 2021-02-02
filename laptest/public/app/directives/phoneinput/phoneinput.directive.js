(function () {
  'use strict';

  angular.module('RowBoat.directives')
      .directive('phoneInput', phoneInput)
      .filter('tel', tel);

  function phoneInput($filter,$browser) {
    return {
        restrict: 'AE',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModelCtrl) {
            var listener = function() {
                var value = $element.val().replace(/[^0-9]/g, '');
                $element.val($filter('tel')(value, false));
            };

            ngModelCtrl.$parsers.push(function(viewValue) {
                return viewValue.replace(/[^0-9]/g, '').slice(0,10);
            });

            ngModelCtrl.$render = function() {
                $element.val($filter('tel')(ngModelCtrl.$viewValue, false));
            };

            $element.bind('change', listener);
            $element.bind('keydown', function(event) {
                var key = event.keyCode;
                if (key == 91 || (15 < key && key < 19) || (37 <= key && key <= 40)){
                    return;
                }
                $browser.defer(listener);
            });

            $element.bind('paste cut', function() {
                $browser.defer(listener);
            });
        }

    };
  }

  function tel() {
    return function (tel) {
        if (!tel) { return ''; }

        var value = tel.toString().trim().replace(/^\+/, '');

        if (value.match(/[^0-9]/)) {
            return tel;
        }
        var number = value.slice(0);

        if(number){
            if(number.length>7){
                number = number.slice(0, 3) + '-' + number.slice(3,7) + '-' + number.slice(7,10);
            }else if(number.length>3){
                number = number.slice(0, 3) + '-' + number.slice(3,7);
            }
            else{
                number = number;
            }
            return number.trim();
        }
        else{
            return number;
        }

    };
  }

})();