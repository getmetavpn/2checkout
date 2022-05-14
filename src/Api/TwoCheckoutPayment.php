<?php
namespace GetMetaVpn\TwoCheckout\Api;

use GetMetaVpn\TwoCheckout\TwoCheckout;

class TwoCheckoutPayment extends TwoCheckout
{
    public static function retrieve()
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/acct/list_payments';
        $result = $request->doCall($urlSuffix);
        $response = TwoCheckoutUtil::returnResponse($result);
        return $response;
    }

    public static function pending()
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/acct/detail_pending_payment';
        $result = $request->doCall($urlSuffix);
        $response = TwoCheckoutUtil::returnResponse($result);
        return $response;
    }

}