
define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'Magento_Catalog/js/product/storage/storage-service',
    'underscore',
    'knockout',
    'jquery',
    'mage/translate'
], function (Component, customerData, storage, _, ko, $, $t) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Algoritma_Promo3x2/promo3x2',
            freeElement: '',
            lowestPrice: 0,
            message: '',
            promotionValue: 3,
            tracks: {
                freeElement: true
            }
        },
        initialize: function () {
            this._super();
            var self = this;
            var cart = customerData.get('cart');
            customerData.getInitCustomerData().done(function () {
                self.getFreeItem(cart(), self);

                self.message = ko.computed(function (){

                    if(_.isUndefined(cart().subtotal) || cart().subtotal === 0) { // subtotal = 0, return messageDefault
                        return  $.mage.__('If you buy at least 3 products, the cheapest is free');
                    }

                    if (cart().summary_count < self.promotionValue) {
                        if((self.promotionValue - cart().summary_count) === 1){
                            return $.mage.__('Add to cart ' + (self.promotionValue - cart().summary_count) + ' item to get access to the promotion 3x2');
                        } else {
                            return $.mage.__('Add to cart ' + (self.promotionValue - cart().summary_count) + ' items to get access to the promotion 3x2');
                        }
                    }

                    if(cart().summary_count >= self.promotionValue){
                        console.log(self.freeElement);
                        return $.mage.__('Congratulations! You can get access to the promotion 3x2! You get ' + self.freeElement + ' free');
                    }
                });
            });

            cart.subscribe(()=>{self.getFreeItem(cart(), self)})


        },



        getFreeItem: function (cart, self){
            if( cart.summary_count >= self.promotionValue ) {

                if(self.lowestPrice === 0 ) {
                    self.lowestPrice = cart.items[0].product_price_value;
                    self.freeElement = cart.items[0].product_name;
                }

                cart.items.forEach(item=> {
                    if(item.product_price_value < self.lowestPrice ){
                        self.lowestPrice = item.product_price_value;
                        self.freeElement = item.product_name;
                    }
                });
                console.log(cart);
                cart.subtotalAmount = cart.subtotalAmount - self.lowestPrice;
                cart.subtotal = "<span class=\"price\">$"+cart.subtotalAmount+"</span>";
                cart.subtotal_excl_tax = cart.subtotal;
                cart.subtotal_incl_tax = cart.subtotal;
                // // customerData.set('cart', cart);
                // console.log(cart);
                console.log(storage.getStorage('namespace'));
            }
        }
    });
})
