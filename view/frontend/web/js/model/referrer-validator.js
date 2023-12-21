/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
define(
    ['jquery', 'mage/translate', 'Magento_Ui/js/model/messageList'],
    function ($, $t, messageList) {
        'use strict';
        return {
            validate: function () {
                var isValid = true;
                if ($("[name='billingAddress[hl_attributes][referrer]']").length) {
                    if ($("[name='billingAddress[hl_attributes][referrer]']").val() == '') {
                        isValid = false;
                        $("[name='billingAddress[hl_attributes][referrer]']").closest('.field._required').addClass('_error');
                        messageList.addErrorMessage({ message: $t('Please fill all the required fields') });
                    }
                }

                return isValid;
            }
        }
    }
);
