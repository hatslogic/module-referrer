<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Hatslogic\Referrer\Helper\Data;
use Magento\Sales\Model\OrderFactory;
use Magento\Checkout\Model\Session;

class SuccessReferal extends Template
{

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var OrderFactory
     */
    protected $_orderFactory;

     /**
      * @param Context $context
      * @param Data $helper
      */

    protected $_checkoutSession;
    public function __construct(
        Context $context,
        Data $helper,
        OrderFactory $orderFactory,
        Session $checkoutSession
    ) {
        parent::__construct($context);
        $this->helper = $helper;
        $this->_orderFactory = $orderFactory;
        $this->_checkoutSession = $checkoutSession;
    }

    /**
     * @return array
     */
    public function getReferralOptions()
    {
        return $this->helper->getReferrerOptions();
    }

    /**
     * @return array
     */
    public function getAllDisplayPages()
    {
        return $this->helper->getDisplayPages();
    }

    /**
     * @return string
     */
    public function getRequired()
    {
        return $this->helper->getConfig("hlreferrer/general/required");
    }

    /**
     * @return string
     */
    public function getReferrerTitle()
    {
        return $this->helper->getConfig("hlreferrer/general/referrer_title");
    }

    /**
     * @return string
     */
    public function canTitleBeDisplayed()
    {
        return $this->helper->getConfig("hlreferrer/general/display_title");
    }

    /**
     * @return string
     */
    public function isEnabled()
    {
        return $this->helper->getConfig("hlreferrer/general/enable");
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
         $lastorderId = $this->_checkoutSession->getLastOrderId();
         return $lastorderId;
    }

    /**
     * @return bool
     */
    public function checkReferral($orderId)
    {
        $order = $this->_orderFactory->create()->load($orderId);
        if ($order->getReferrer()) {
            return false;
        } else {
            return true;
        }
    }
}
