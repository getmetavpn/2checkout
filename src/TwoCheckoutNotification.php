<?php
namespace GetMetaVpn\TwoCheckout;

use GetMetaVpn\TwoCheckout\Api\TwocheckoutUtil;

class TwoCheckoutNotification extends Twocheckout
{

    public static function check($insMessage=array(), $secretWord)
    {
        $hashSid = $insMessage['vendor_id'];
        $hashOrder = $insMessage['sale_id'];
        $hashInvoice = $insMessage['invoice_id'];
        $StringToHash = strtoupper(md5($hashOrder . $hashSid . $hashInvoice . $secretWord));
        if ($StringToHash != $insMessage['md5_hash']) {
            $result = TwoCheckoutMessage::message('Fail', 'Hash Mismatch');
        } else {
            $result = TwoCheckoutMessage::message('Success', 'Hash Matched');
        }
        return TwoCheckoutUtil::returnResponse($result);
    }

}
