<?php

namespace Iyzipay\Model\Mapper;

use Iyzipay\Model\RefundChargedFromMerchant;

class RefundChargedFromMerchantMapper extends IyzipayResourceMapper
{
    public static function create()
    {
        return new RefundChargedFromMerchantMapper();
    }

    public function map(RefundChargedFromMerchant $refund, $jsonResult)
    {
        parent::map($refund, $jsonResult);

        if(isset($jsonResult->paymentId)) {
            $refund->setPaymentId($jsonResult->paymentId);
        }
        if(isset($jsonResult->paymentTransactionId)) {
            $refund->setPaymentTransactionId($jsonResult->paymentTransactionId);
        }
        if(isset($jsonResult->price)) {
            $refund->setPrice($jsonResult->price);
        }
        return $refund;
    }
}