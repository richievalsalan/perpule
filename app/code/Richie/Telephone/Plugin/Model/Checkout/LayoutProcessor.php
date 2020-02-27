<?php

namespace Richie\Telephone\Plugin\Model\Checkout;


use Magento\Checkout\Model\Session as CartSession;

class LayoutProcessor
{

    /**
     * @var CartSession
     */
    private $session;

    public function __construct(
        CartSession $session
    )
    {
        $this->session = $session;
    }

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {

        $telephoneValue = $this->session->getQuote()->getShippingAddress()->getTelephone();

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['telephone']['value'] = $telephoneValue;

        return $jsLayout;
    }
}
