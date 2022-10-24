define([
    'uiComponent',
    'ko',
    'Macademy_InventoryFulFillment/js/model/box-configurations',
    'Macademy_InventoryFulFillment/js/model/sku',
    'jquery'
], function (
    Component,
    ko,
    boxConfigurationModel,
    skuModel,
    $
) {
    'use strict';



    return Component.extend({
        defaults: {
            boxConfigurationModel: boxConfigurationModel,
            skuModel: skuModel
        },
        initialize(){
            this._super();


            skuModel.isSuccess.subscribe((value)=>{
                console.log('SKU_Succ. __NEW__',value);
            });
            skuModel.isSuccess.subscribe((value)=>{
                console.log('SKU_Succ. __OLD__',value);
            }, null, 'beforeChange');
        },

        handleAdd() {
            boxConfigurationModel.add();
        },

        handleDelete(index){
            boxConfigurationModel.delete(index);
        },

        handleSubmit(){
            $('.box-configurations form').removeAttr('aria-invalid');

            if($('.box-configurations form').valid()) {
                boxConfigurationModel.isSuccess(true);
            } else {
                boxConfigurationModel.isSuccess(false);
            }
        }

    })
})
