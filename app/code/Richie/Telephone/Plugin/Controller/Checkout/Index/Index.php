<?php

namespace Richie\Telephone\Plugin\Controller\Checkout\Index;

use Magento\Checkout\Model\Session as CartSession;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Customer\Model\Session as CustomerSession;

class Index
{

	/**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var CartSession
     */
    private $cartSession;

    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var CustomerSession
     */
    private $customerSession;


    public function __construct(
		ResponseInterface $response,
		CartSession $cartSession,
		UrlInterface $url,
        CustomerSession $customerSession
	)
	{
		$this->response = $response;
		$this->url = $url;
		$this->cartSession = $cartSession;
        $this->customerSession = $customerSession;
    }

	public function beforeExecute($subject)
	{
		$quote = $this->cartSession->getQuote();
		$shippingAddress = $quote->getShippingAddress();

		//This is to check if the customer is logged in and has a default shipping address
		if($this->customerSession->isLoggedIn()) {
		    if($this->customerSession->getCustomer()->getDefaultShippingAddress()) {
		        $shippingAddress = $this->customerSession->getCustomer()->getDefaultShippingAddress();
            }
        }

		if(!$shippingAddress->getTelephone()) {
			$url = $this->url->getUrl('telephone/enterphone');
			return $this->response->setRedirect($url);
		}
	}
}
