(function () {
  'use strict';

  var IMAGES_ROOT = 'assets/img/';

  angular.module('RowBoat.theme')
    .constant('layoutSizes', {
      resWidthCollapseSidebar: 1200,
      resWidthHideSidebar: 500
    })
    .constant('layoutPaths', {
      images: {
        root: IMAGES_ROOT,
        profile: IMAGES_ROOT + 'app/profile/',
        amMap: 'assets/img/theme/vendor/ammap//dist/ammap/images/',
        amChart: 'assets/img/theme/vendor/amcharts/dist/amcharts/images/'
      }
    })
    .constant('colorHelper', {
      tint: function(color, weight) {
        return mix('#ffffff', color, weight);
      },
      shade: function(color, weight) {
        return mix('#000000', color, weight);
      },
    });

  function shade(color, weight) {
    return mix('#000000', color, weight);
  }

  function tint(color, weight) {
    return mix('#ffffff', color, weight);
  }

  function mix(color1, color2, weight) {
    function d2h(d) {
      return d.toString(16);
    }
    function h2d(h) {
      return parseInt(h, 16);
    }

    var result = "#";
    for(var i = 1; i < 7; i += 2) {
      var color1Part = h2d(color1.substr(i, 2));
      var color2Part = h2d(color2.substr(i, 2));
      var resultPart = d2h(Math.floor(color2Part + (color1Part - color2Part) * (weight / 100.0)));
      result += ('0' + resultPart).slice(-2);
    }
    return result;
  }
})();
