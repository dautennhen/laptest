(function () {
    'use strict';

    angular.module('RowBoat.directives')
        .directive('strongSecret', strongSecret);

    function strongSecret($filter, $browser) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attr, ctrl) {
                function customValidator(ngModelValue) {
                    if (/[A-Z]/.test(ngModelValue)) {
                        ctrl.$setValidity('uppercaseValidator', true);
                    } else {
                        ctrl.$setValidity('uppercaseValidator', false);
                    }
                    if (/[0-9]/.test(ngModelValue)) {
                        ctrl.$setValidity('numberValidator', true);
                    } else {
                        ctrl.$setValidity('numberValidator', false);
                    }
                    if (ngModelValue.length >= 6) {
                        ctrl.$setValidity('sixCharactersValidator', true);
                    } else {
                        ctrl.$setValidity('sixCharactersValidator', false);
                    }
                    return ngModelValue;
                }
                ctrl.$parsers.push(customValidator);
            }

        };
    }

})();