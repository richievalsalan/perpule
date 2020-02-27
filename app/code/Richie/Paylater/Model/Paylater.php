<?php

namespace Richie\Paylater\Model;

use Magento\Payment\Model\Method\AbstractMethod;

class Paylater extends AbstractMethod
{
    const PAYMENT_METHOD_CUSTOM_INVOICE_CODE = 'paylater';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_CUSTOM_INVOICE_CODE;
}
