<?php

namespace GetMetaVpn\TwoCheckout\Api;

class TwoCheckoutContact extends TwoCheckoutAccount
{
    public static function retrieve()
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/acct/detail_contact_info';
        $result = $request->doCall($urlSuffix);
        return TwoCheckoutUtil::returnResponse($result);
    }
}