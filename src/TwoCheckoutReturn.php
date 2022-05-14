<?php

namespace GetMetaVpn\TwoCheckout;

use GetMetaVpn\TwoCheckout\Api\TwoCheckoutUtil;

class TwoCheckoutReturn extends TwoCheckout
{

    public static function check($params=array(), $secretWord)
    {
        $hashSecretWord = $secretWord;
        $hashSid = $params['sid'];
        $hashTotal = $params['total'];
        $hashOrder = $params['order_number'];
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
        if ($StringToHash != $params['key']) {
            $result = TwoCheckoutMessage::message('Fail', 'Hash Mismatch');
        } else {
            $result = TwoCheckoutMessage::message('Success', 'Hash Matched');
        }
        return TwoCheckoutUtil::returnResponse($result);
    }

}