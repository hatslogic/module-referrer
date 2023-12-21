<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Block\Checkout;

use Magento\Customer\Model\Address\Config as AddressConfig;

class Addresses extends \Magento\Multishipping\Block\Checkout\Addresses
{
    /**
     * @var \Magento\Framework\Filter\DataObject\GridFactory
     */
    protected $_filterGridFactory;

    /**
     * @var \Magento\Multishipping\Model\Checkout\Type\Multishipping
     */
    protected $_multishipping;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var \Magento\Customer\Model\Address\Config
     */
    private $_addressConfig;

    /**
     * @var \Magento\Customer\Model\Address\Mapper
     */
    protected $addressMapper;

    /**
     * @var \Hatslogic\Referrer\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Filter\DataObject\GridFactory $filterGridFactory
     * @param \Magento\Multishipping\Model\Checkout\Type\Multishipping $multishipping
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param AddressConfig $addressConfig
     * @param \Magento\Customer\Model\Address\Mapper $addressMapper
     * @param \Hatslogic\Referrer\Helper\Data $helper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Filter\DataObject\GridFactory $filterGridFactory,
        \Magento\Multishipping\Model\Checkout\Type\Multishipping $multishipping,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        AddressConfig $addressConfig,
        \Magento\Customer\Model\Address\Mapper $addressMapper,
        \Hatslogic\Referrer\Helper\Data $helper,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $filterGridFactory,
            $multishipping,
            $customerRepository,
            $addressConfig,
            $addressMapper,
            $data
        );
        $this->helper = $helper;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    /**
     * @return array
     */
    public function getReferrerOptions()
    {
        return $this->helper->getReferrerOptions();
    }

    /**
     * @param string $path
     * @return string
     */
    public function getConfig($path)
    {
        return $this->helper->getConfig($path);
    }

    /**
     * @return string
     */
    public function getReferrerValue()
    {
        $quote = $this->checkoutSession->getQuote();
        return $quote->getReferrer();
    }
}
