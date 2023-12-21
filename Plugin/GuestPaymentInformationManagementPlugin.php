<?php
/**
 * @author 2hatslogic
 * @copyright Copyright (c) 2023 2hatslogic (https://www.2hatslogic.com)
 * @package Hatslogic_Referrer
 */
namespace Hatslogic\Referrer\Plugin;
/**
 * One page checkout processing model
 */

use Magento\Checkout\Model\GuestPaymentInformationManagement;
use Magento\Checkout\Model\Session;

class GuestPaymentInformationManagementPlugin
{

    /**
     * Persistence Session Helper.
     *
     * @var \Magento\Persistent\Helper\Session
     */
    private $persistenceSessionHelper;

    /**
     * Persistence Data Helper.
     *
     * @var \Magento\Persistent\Helper\Data
     */
    private $persistenceDataHelper;

    /**
     * Customer Session.
     *
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * Checkout Session.
     *
     * @var \Magento\Checkout\Model\Session
     */
    private $checkoutSession;

    /**
     * Quote Manager.
     *
     * @var \Magento\Persistent\Model\QuoteManager
     */
    private $quoteManager;

    /**
     * Cart Repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    private $cartRepository;

    /**
     * Initialize dependencies.
     */
    public function __construct(
        \Magento\Persistent\Helper\Data $persistenceDataHelper,
        \Magento\Persistent\Helper\Session $persistenceSessionHelper,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Persistent\Model\QuoteManager $quoteManager,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepository
    ) {
        $this->persistenceDataHelper = $persistenceDataHelper;
        $this->persistenceSessionHelper = $persistenceSessionHelper;
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
        $this->quoteManager = $quoteManager;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Convert customer cart to guest cart before order is placed if customer is not logged in.
     *
     * @param string $cartId
     * @param string $email
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSavePaymentInformation(
        GuestPaymentInformationManagement $subject,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ) {
        $quoteId = $this->checkoutSession->getQuoteId();
        $quote = $this->cartRepository->get($quoteId);
        $paymentExtension =$paymentMethod->getExtensionAttributes();
        
        if ($paymentExtension->getReferrer())
           $referrer = $paymentExtension->getReferrer();
        else
           $referrer = '';

       $quote->setReferrer($referrer);
       $this->cartRepository->save($quote);
        
    }

}

