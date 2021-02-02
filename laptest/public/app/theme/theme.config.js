(function () {
  'use strict';

  angular.module('RowBoat.theme')
    .config(config);

  function config(baConfigProvider, colorHelper) {
    baConfigProvider.changeTheme({blur: true});
    
    baConfigProvider.changeColors({
     default: 'rgba(#000000, 0.2)',
     defaultText: '#ffffff',
     dashboard: {
       white: '#ffffff',
     },
    });
  }
})();
