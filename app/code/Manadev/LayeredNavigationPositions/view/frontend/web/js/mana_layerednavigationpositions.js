define([
    'jquery',
    'mage/loader'
], function ($) {
    $.widget("mana.mana_layerednavigationpositions", {
        options: {
            menu_min_width: 0,
            menu_max_width: 0,
            filter_item_class: ".filter-options-item:not(.mana-inline-slider)",
            menu_popup_class: ".filter-options-content"
        },

        _create: function () {
            this._bindHoverEventToFilterItems();
            var self = this;
            this.element.find(this.options.menu_popup_class).each(function() {
                $(this).css("min-width", self.options.menu_min_width + "px");
                $(this).css("max-width", self.options.menu_max_width + "px");
            })
        },
        _destroy: function () {

        },

        // Private Events

        _bindHoverEventToFilterItems: function () {
            this.element.find(this.options.filter_item_class).hover(function () {
                    var self = this;
                    $(this).addClass('hover');
                    $(document).trigger('mana-after-show', [self]);
                },
                function () {
                    $(this).removeClass('hover');
                }
            )
        }
    });

    return $.mana.mana_layerednavigationpositions;
});