<?php

namespace GetMetaVpn\TwoCheckout\Api;

use GetMetaVpn\TwoCheckout\TwoCheckout;

class TwoCheckoutProduct extends TwoCheckout
{
    public static function create($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/products/create_product';
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function retrieve($params = array())
    {
        $request = new TwoCheckoutApi();
        if (array_key_exists("product_id", $params)) {
            $urlSuffix = '/api/products/detail_product';
        } else {
            $urlSuffix = '/api/products/list_products';
        }
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function update($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/products/update_product';
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function delete($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/products/delete_product';
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }
}