var config = {
    map:{
        '*': {
            'Magento_Checkout/template/sidebar': 'Macademy_CheckoutMessages/template/sidebar'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/summary/cart-items': {
                'Macademy_CheckoutMessages/js/view/summary/cart-items-mixin': true
            }
        }
    }
}
