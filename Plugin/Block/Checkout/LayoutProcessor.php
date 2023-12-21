<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */

namespace Hatslogic\Referrer\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * @var \Hatslogic\Referrer\Helper\Data
     */
    protected $_helper;

    /**
     * @param \Hatslogic\Referrer\Helper\Data $helper
     */
    public function __construct(
        \Hatslogic\Referrer\Helper\Data $helper
    ) {
        $this->_helper = $helper;
    }

    /**
     * Checkout LayoutProcessor after process plugin.
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $processor, $jsLayout)
    {
        if (!$this->_helper->isEnabled()) {
            return $jsLayout;
        }

        if (count($this->_helper->getReferrerOptions()) <= 1) {
            return $jsLayout;
        }

        $labelCanDisplay = $this->_helper->getConfig('hlreferrer/general/display_title');
        $displayArea = $this->_helper->getConfig('hlreferrer/general/display_area');
        if ($displayArea == 'payment') {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']['before-place-order']['children']['referrer'] = [
                'component' => 'Magento_Ui/js/form/element/select',
                'config' => [
                    'customScope' => 'billingAddress',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/select',
                ],
                'dataScope' => 'billingAddress.hl_attributes.referrer',
                'label' => ($labelCanDisplay) ? $this->_helper->getConfig('hlreferrer/general/referrer_title') : '',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'sortOrder' => 50,
                'validation' => [
                    'required-entry' => ($this->_helper->getConfig('hlreferrer/general/required')) ? true : false
                ],
                'options' => $this->_helper->getReferrerOptions(),
            ];

            if ($this->_helper->getConfig('hlreferrer/general/required')) {
                $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['additional-payment-validators']['children']['referrer-validator']
                ['component'] = 'Hatslogic_Referrer/js/view/referrer-validation';
            }
        } else {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['custom-checkout-form'] = [
                'component' => 'uiComponent',
                'displayArea' => 'custom-checkout-form',
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['custom-checkout-form']['children']['custom-checkout-form-container'] = [
                'sortOrder' => '0',
                'component' => 'uiComponent',
                'provider' => 'checkoutProvider',
                'config' => [
                    'template' => 'Hatslogic_Referrer/checkout/custom-checkout-form'
                ],
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['custom-checkout-form']['children']['custom-checkout-form-container']['children']['custom-checkout-form-fieldset']= [
                'component' => 'uiComponent',
                'displayArea' => 'custom-checkout-form-fields',
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['custom-checkout-form']['children']['custom-checkout-form-container']['children']['custom-checkout-form-fieldset']['children']['referrer'] = [
                'component' => 'Magento_Ui/js/form/element/select',
                'config' => [
                    'customScope' => 'customCheckoutForm',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/select',
                ],
                'dataScope' => 'customCheckoutForm.hl_attributes.referrer',
                'label' => ($labelCanDisplay) ? $this->_helper->getConfig('hlreferrer/general/referrer_title') : '',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'sortOrder' => 999,
                'validation' => [
                    'required-entry' => ($this->_helper->getConfig('hlreferrer/general/required')) ? true : false
                ],
                'options' => $this->_helper->getReferrerOptions(),
            ];
        }

        return $jsLayout;
    }
}
