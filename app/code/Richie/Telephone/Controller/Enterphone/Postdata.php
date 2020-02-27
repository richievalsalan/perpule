<?php

namespace Richie\Telephone\Controller\Enterphone;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Session as CartSession;

class Postdata extends Action
{
    /**
     * @var CartSession
     */
    private $session;

    public function __construct(
        Context $context,
        CartSession $session
    )
    {
        parent::__construct($context);
        $this->session = $session;
    }

    public function execute()
    {
        $telephone = $this->getRequest()->getParam('telephone');
        $shippingAddress = $this->session->getQuote()->getShippingAddress();

        $shippingAddress->setTelephone($telephone)->save();

        $this->_redirect('checkout/index/index');
    }
}

