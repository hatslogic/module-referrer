/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/place-order': {
                'Hatslogic_Referrer/js/order/place-order-mixin': true
            },
            'Magento_Checkout/js/action/set-payment-information': {
                'Hatslogic_Referrer/js/order/set-payment-information-mixin': true
            },
            'Magento_Checkout/js/view/shipping': {
                'Hatslogic_Referrer/js/view/shipping-mixin': true
            }
        }
    }
};
