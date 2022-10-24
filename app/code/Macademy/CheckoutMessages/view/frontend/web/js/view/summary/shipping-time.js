define(['uiComponent'], function (Component) {
    return Component.extend({
        defaults: {
            '${ $.name }shippingAddressProvider': '${ $.name }AddressProvider',
            tracks: {
                countryId: true
            },
            // imports: {
            //     countryId: 'checkoutProvider:shippingAddress.country_id'
            // }
            listens: {
                '${ $.shippingAddressProvider }.country_id': 'countryId',
                '${ $.shippingAddressProvider }.region_id': 'handleRegionChange'
            }
        },

        initialize: function () {
            this._super();
            console.log(this.name + ' is initialized.');
        },

        showMessage: function () {
            return this.countryId === 'US';
        },
        handleRegionChange: function (newRegionId){
            // console.log('new Region id ' + newRegionId);
        }
    })
})
