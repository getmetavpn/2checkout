<?php

namespace GetMetaVpn\TwoCheckout\Api;

use GetMetaVpn\TwoCheckout\TwoCheckout;
use GetMetaVpn\TwoCheckout\TwoCheckoutMessage;

class TwoCheckoutSale extends TwoCheckout
{
    public static function retrieve($params = array())
    {
        $request = new TwoCheckoutApi();
        if (array_key_exists("sale_id", $params) || array_key_exists("invoice_id", $params)) {
            $urlSuffix = '/api/sales/detail_sale';
        } else {
            $urlSuffix = '/api/sales/list_sales';
        }
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function refund($params = array())
    {
        $request = new TwoCheckoutApi();
        if (array_key_exists("lineitem_id", $params)) {
            $urlSuffix = '/api/sales/refund_lineitem';
            $result = $request->doCall($urlSuffix, $params);
        } elseif (array_key_exists("invoice_id", $params) || array_key_exists("sale_id", $params)) {
            $urlSuffix = '/api/sales/refund_invoice';
            $result = $request->doCall($urlSuffix, $params);
        } else {
            $result = TwoCheckoutMessage::message('Error', 'You must pass a sale_id, invoice_id or lineitem_id to use this method.');
        }
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function stop($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/sales/stop_lineitem_recurring';
        if (array_key_exists("lineitem_id", $params)) {
            $result = $request->doCall($urlSuffix, $params);
        } elseif (array_key_exists("sale_id", $params)) {
            $result = TwocheckoutSale::retrieve($params);
            if (!is_array($result)) {
                $result = TwoCheckoutUtil::returnResponse($result, 'array');
            }
            $lineitemData = TwoCheckoutUtil::getRecurringLineitems($result);
            if (isset($lineitemData[0])) {
                $stoppedLineitems = array();
                foreach ($lineitemData as $value) {
                    $params = array('lineitem_id' => $value);
                    $result = $request->doCall($urlSuffix, $params);
                    $result = json_decode($result, true);
                    if ($result['response_code'] == "OK") {
                        $stoppedLineitems[] = $value;
                    }
                }
                $result = TwoCheckoutMessage::message('OK', $stoppedLineitems);
            } else {
                throw new TwoCheckoutError("No recurring lineitems to stop.");
            }
        } else {
            throw new TwoCheckoutError('You must pass a sale_id or lineitem_id to use this method.');
        }
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function active($params = array())
    {
        if (array_key_exists("sale_id", $params)) {
            $result = TwocheckoutSale::retrieve($params);
            if (!is_array($result)) {
                $result = TwoCheckoutUtil::returnResponse($result, 'array');
            }
            $lineitemData = TwoCheckoutUtil::getRecurringLineitems($result);
            if (isset($lineitemData[0])) {
                $result = TwoCheckoutMessage::message('OK', $lineitemData);
                return TwoCheckoutUtil::returnResponse($result);
            } else {
                throw new TwoCheckoutError("No active recurring lineitems.");
            }
        } else {
            throw new TwoCheckoutError("You must pass a sale_id to use this method.");
        }
    }

    public static function comment($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/sales/create_comment';
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

    public static function ship($params = array())
    {
        $request = new TwoCheckoutApi();
        $urlSuffix = '/api/sales/mark_shipped';
        $result = $request->doCall($urlSuffix, $params);
        return TwoCheckoutUtil::returnResponse($result);
    }

}
