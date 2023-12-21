/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Hatslogic_Referrer/js/model/referrer-validator'
    ],
    function (Component, additionalValidators, yourValidator) {
        'use strict';
        additionalValidators.registerValidator(yourValidator);
        return Component.extend({});
    }
);