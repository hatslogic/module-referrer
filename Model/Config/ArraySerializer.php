<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Model\Config;

use Magento\Config\Model\Config\Backend\Serialized\ArraySerialized;

class ArraySerializer extends ArraySerialized
{
    /**
     * Save Referrer Options based on sort order
     */
    public function beforeSave()
    {
        $optionsArray = $this->getValue();
        $filteredArray = array_filter($optionsArray);
        $columns = array_column($filteredArray, 'option_order');
        array_multisort($columns, SORT_ASC, $filteredArray);

        $this->setValue($filteredArray);

        return parent::beforeSave();
    }
}
