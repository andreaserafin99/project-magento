require(['jquery'], function ($) {
    $(document).ready (function() {
        $('.home-section-two-left a').click(function(){
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 1500);
            return false;
        });
    });
    $(document).ready (function() {
        if ($(window).width() <768) {
            $('.nuovi-prodotti-random .new-arrivals-box').insertBefore('.nuovi-prodotti-random .attribute-products-grid .product.product-item:nth-child(9)');
            $('.nuovi-prodotti-random .new-arrivals-image-clearer').insertAfter('.nuovi-prodotti-random .new-arrivals-box');
        }
    });

    $(document).ready(function() {
        $('.category-product-actions').css('visibility', 'visible');
        $('.mana-filter-block.mana-filter-block-above-menu').prependTo('.category-product-actions');
        $('.mana-filter-custom-sorter:first').hide();

    });

    $(document).ready (function () {
        $('.minicart-items .details-qty.qty').prependTo('.minicart-items .price-container');
        $('.product.alert.stock').appendTo('.product-add-form');
    });

    $(document).ready (function () {
        $(document).on('click', '.custom-filter-tab .block-content.filter-content button.action.close-nav-button',function() {
            $("html").removeClass("filter-open");
        });
    });
    $(document).ready(function(){
        $('.paypal-button').css('border-radius', '0 !important');
    });
    $(document).ready(function(){
        $('div#amprivacy-checkbox').appendTo('.custom-amasty-gdpr');
    });
    $(document).ready(function(){
        $('.filter-toggle .title').click(function(){
            $('html').toggleClass('filter-open');
        });
    });
    $(window).load(function() {
        $(document).on('keyup', '.giftcard-design-open-amount',function() {

            if ($.trim($('.giftcard-design-open-amount').val()).length) {
                $(this).parent('.giftcard-design-input-fake').addClass('active');
                $('li.giftcard-design-button-container').removeClass('active');
            } else {
                $(this).parent('li.giftcard-design-button-container').removeClass('active');
            }
        });
        $(document).on('click', '.giftcard-design-button-container', function(e) {
            var container = $(".giftcard-design-input-fake");

            if (!container.is(e.target) && container.has(e.target).length === 0)
            {
                container.removeClass('active');
            }
        });
    });

});
