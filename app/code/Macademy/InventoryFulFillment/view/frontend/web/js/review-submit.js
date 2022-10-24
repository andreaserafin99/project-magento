define([
    'uiComponent',
    'ko',
    'Macademy_InventoryFulFillment/js/model/box-configurations',
    'Macademy_InventoryFulFillment/js/ko/extenders/numeric'
], function (
    Component,
    ko,
    boxConfigurationModel
){
    'use strict';

    return Component.extend({
        defaults: {
            boxConfigurationModel: boxConfigurationModel,
            termsConditionsCheck: ko.observable(false),
        },
        initialize(){
            this._super();
            this.numberOfBoxes = ko.computed(()=>{
                return boxConfigurationModel.boxConfigurations().reduce(function(runningTotal, boxConfiguration){
                    return runningTotal + (boxConfiguration.numberOfBoxes() || 0);
                }, 0);
            });

            this.shipmentWeight = ko.computed(()=>{
                return boxConfigurationModel.boxConfigurations().reduce(function(runningTotal, boxConfiguration){
                    return runningTotal + (boxConfiguration.totalWeight() || 0);
                }, 0);
            })

            this.billableWeight = ko.computed(()=>{
                return boxConfigurationModel.boxConfigurations().reduce(function(runningTotal, boxConfiguration){
                    return runningTotal + (boxConfiguration.billableWeight() || 0);
                }, 0);
            })
        },
    })
})
