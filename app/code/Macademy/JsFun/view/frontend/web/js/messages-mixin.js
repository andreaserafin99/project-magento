define([], function (){
    'use strict'

    return function (originalMessages){
        // originalMessages.defaults.hideTimeout = 100;
        return originalMessages.extend({
            defaults:{
                template: 'Macademy_JsFun/messages-custom',
                hideTimeout: 3000,
                hideSpeed: 100
            }
        });
    }
})
