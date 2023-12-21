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
class PaymentInformationManagementPlugin
{

    protected $orderRepository;
    protected $paymentFactory;
    protected $logger;
    protected $quoteRepository;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Quote\Api\Data\PaymentExtensionFactory $paymentFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->paymentFactory = $paymentFactory;
        $this->logger = $logger;
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSavePaymentInformation(
        \Magento\Checkout\Api\PaymentInformationManagementInterface $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        $paymentExtension =$paymentMethod->getExtensionAttributes();
        
        if ($paymentExtension->getReferrer())
           $referrer = $paymentExtension->getReferrer();
        else
           $referrer = '';

       $quote->setReferrer($referrer);
    }
}