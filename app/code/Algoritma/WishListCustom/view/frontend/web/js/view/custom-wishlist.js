define([
    'jquery',
], function ($) {
    'use strict';

    return function (widget) {

        $.widget('mage.wishlist', widget, {
            options: {
              btnRemoveAllSelector: '[data-role=remove-all]'
            },
            _create: function (){
                // this.element.on('click', this.options.btnRemoveAllSelector, $.proxy(function (event) {
                //     console.log('delete all clicked');
                // }));

                console.log('overrided');
                widget._super();
            },
            // clearAll: function () {
            //     this.element.on('click', this.options.btnRemoveAllSelector, $.proxy(function (event) {
            //         console.log('delete all clicked');
            //     }))
            // }
        });

        return $.mage.wishlist;
    }
});
