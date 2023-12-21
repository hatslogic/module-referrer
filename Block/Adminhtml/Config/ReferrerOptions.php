<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */

namespace Hatslogic\Referrer\Block\Adminhtml\Config;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class ReferrerOptions extends AbstractFieldArray
{
    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('option_name', ['label' => __('Name'), 'class' => 'required-entry']);
        $this->addColumn('option_order', ['label' => __('Sort Order'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
