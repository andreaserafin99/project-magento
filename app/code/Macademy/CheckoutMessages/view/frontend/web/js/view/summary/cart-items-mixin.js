define([], function (){
    'use strict';

    return function (Component){

      return Component.extend({
          defaults: {
              template: 'Macademy_CheckoutMessages/summary/cart-items',
              exports: {
                  'totals.subtotal': 'checkout.sidebar.guarantee:subtotal'
              }
          },

          isItemsBlockExpanded: function (){
              return true;
          },
      })
    };
})
