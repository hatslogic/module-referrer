<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Model\Config\Source;

class DisplayPages implements \Magento\Framework\Option\ArrayInterface
{
    
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'checkout', 'label' => __('Checkout Page')],
            ['value' => 'success', 'label' => __('Success Page')],
            ['value' => 'registration', 'label' => __('Registration Page')]
        ];
    }
}
