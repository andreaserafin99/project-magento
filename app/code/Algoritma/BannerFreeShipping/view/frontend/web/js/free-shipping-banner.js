
define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'underscore',
    'knockout'
], function (Component, customerData, _, ko) {
    'use strict';
    return Component.extend({

        defaults: {
            freeShippingThreshold: 100,
            template: 'Algoritma_Promo3x2/promo3x2',
            subtotal: '0.00',
            tracks: {
                subtotal: true
            }
        },

        initialize: function () {
            this._super();
            var self = this;
            var cart = customerData.get('cart');

            customerData.getInitCustomerData().done(function () {
                console.log(cart());
                if(!_.isEmpty(cart()) && !_.isUndefined(cart().subtotalAmount)){
                    self.subtotal = parseFloat(cart().subtotalAmount);
                }
            });

            cart.subscribe(function(cart){
                if(!_.isEmpty(cart) && !_.isUndefined(cart.subtotalAmount)){
                    self.subtotal = parseFloat(cart.subtotalAmount);
                }
            })

            self.message = ko.computed(function (){

                if(_.isUndefined(self.subtotal) || self.subtotal === 0) { // subtotal = 0, return messageDefault
                    return self.messageDefault;
                }
                if (self.subtotal > 0 && self.subtotal < self.freeShippingThreshold){ // subtotal > 0 and < 100, return messageItemsInCart
                    var subtotalRemaining = self.freeShippingThreshold - self.subtotal;
                    var formattedSubtotalRemaining = self.formatCurrency(subtotalRemaining);
                    return self.messageItemsInCart.replace('xx.xx€', formattedSubtotalRemaining);
                }
                if (self.subtotal >= self.freeShippingThreshold) { // subtotal >= 100, return messageFreeShipping
                    return self.messageFreeShipping;
                }



            });
        },

        formatCurrency: function (value){
            return '$'+value.toFixed(2);
        }

    });
})
