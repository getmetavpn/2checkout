<?php

namespace GetMetaVpn\TwoCheckout;

class TwoCheckoutMessage
{
    public static function message($code, $message)
    {
        $response = array();
        $response['response_code'] = $code;
        $response['response_message'] = $message;
        $response = json_encode($response);
        return $response;
    }
}