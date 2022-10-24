define([], function () {
    'use strict'

    var mixin = {

        /**
         * @param productName string
         */
        getProductNameUnsanitizedHtml: function (productName) {
            return productName + ' AS CUSTOM';
        }
    };

    return function (target) { // target == Result that Magento_Ui/.../columns returns.
        return target.extend(mixin); // new result that all other modules receive
    };

});
