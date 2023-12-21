<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\Serializer\Json;

class Data extends AbstractHelper
{
    /**
     * @var Json
     */
    protected $_serializer;

    /**
     * @param Context $context
     * @param Json $serializer
     */
    public function __construct(
        Context $context,
        Json $serializer
    ) {
        $this->_serializer = $serializer;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->getConfig('hlreferrer/general/enable');
    }

    /**
     * @return string
     */
    public function getReferrerType()
    {
        return $this->getConfig('hlreferrer/general/referrer_type');
    }

    /**
     * @return array
     */
    public function getReferrerOptions()
    {
        $options = $this->getConfig('hlreferrer/general/referrer_options');
        $optionsArray = $this->_serializer->unserialize($options);
        $i = 0;
        $result[$i] = [
            'value' => '',
            'label' => $this->getConfig('hlreferrer/general/referrer_placeholder'),
        ];
        foreach ($optionsArray as $key => $option) {
            $result[++$i] = [
                'value' => $option['option_name'],
                'label' => $option['option_name'],
            ];
        }

        return $result;
    }

    /**
     * @param string $configPath
     * @return config
     */
    public function getConfig($configPath)
    {
        return $this->scopeConfig->getValue($configPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
