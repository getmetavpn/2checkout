<?php

namespace GetMetaVpn\TwoCheckout\Api;

class TwoCheckoutCompany extends TwoCheckoutAccount
{
    public static function retrieve()
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/acct/detail_company_info';
        $result = $request->doCall($urlSuffix);
        return TwoCheckoutUtil::returnResponse($result);
    }

}