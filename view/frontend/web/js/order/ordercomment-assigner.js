/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery'
], function ($) {
    'use strict';


    /** Override default place order action and add comment to request */
    return function (paymentData) {

        if (paymentData['extension_attributes'] === undefined || paymentData['extension_attributes'] === null ) {
            paymentData['extension_attributes'] = {};
        }

        if ( $("[name='billingAddress[hl_attributes][referrer]']").length  && $("[name='billingAddress[hl_attributes][referrer]']").val() !== '' ) {
            
            paymentData['extension_attributes']['referrer'] = $("[name='billingAddress[hl_attributes][referrer]']").val();
        } else if ( $("[name='hl_attributes[referrer]']").length && $("[name='hl_attributes[referrer]']").val() !== '') {
            
            paymentData['extension_attributes']['referrer'] = $("[name='hl_attributes[referrer]']").val();
        }

        console.log(paymentData);
    };
});