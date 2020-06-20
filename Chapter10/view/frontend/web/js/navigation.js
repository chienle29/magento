define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/customer-data'
    ],
    function (
        $,
        ko,
        Component,
        _,
        stepNavigator,
        customerData
    ) {
        'use strict';
        var url = window.BASE_URL;
        const BASE_AUTHENTICATE = url + "checkout/#authenticate";
        const BASE_SHIPPING = url + "checkout/#shipping";
        const BASE_PAYMENT = url + "checkout/#payment";
        const BASE_CART = url + "checkout/cart";
        return Component.extend({
            defaults: {
                template: 'Cate_Chapter10/navigation',
                price: ko.observable(null),
                content: ko.observable(),
            },
            initialize: function(){
                this._super();
                this.content('continue');
                this.price('total $' + Object.values(this.data)[0]);
                if(window.location.href === BASE_PAYMENT){
                    this.price('total $' + Object.values(this.data)[1]);
                    this.content('pay now');
                }
            },
            getNextStep: function () {
                if (window.location.href === BASE_SHIPPING) {
                    this.price('total $' + Object.values(this.data)[1]);
                    this.content('pay now');
                    $('.fa.fa-arrow-right').css('display', 'none');
                    $('#co-shipping-method-form').submit();
                } else {
                    stepNavigator.next();
                    this.content('continue');
                    $('.fa.fa-arrow-right').css('display', 'hidden');
                }

                if(window.location.href === BASE_PAYMENT){
                    $('.action.primary.checkout').trigger('click');
                }
            },
            getPrevStep: function () {
                this.price('total $' + Object.values(this.data)[0]);
                 var currentUrl = window.location.href;
                if (currentUrl === BASE_AUTHENTICATE) {
                    window.location.href = BASE_CART;
                } else if(currentUrl === BASE_PAYMENT) {
                    window.location.href = BASE_SHIPPING;
                } else {
                    window.location.href = BASE_AUTHENTICATE;
                }
            },

        });

    });
