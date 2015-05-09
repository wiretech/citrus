<?php 

namespace Wiretech\Citrus\Classes;

class Citrus {

    public static function response($success = 0, $error = 'An unkown error occured', $data = null)
    {

        $response['succes'] = $success;
        $response['error'] = $error;
        $response['cache'] = null;
        $response['data'] = $data;

        return $response;
    }

    private static function build()
    {
        $data = array();

        $array = func_get_arg(0);

        foreach ($array as $index => $value) {

           $data[$index] = json_decode(json_encode($value), true);
        }

        return $data;
    }

    public static function combine()
    {
        $arg = func_get_arg(0);
        $data = Citrus::build($arg);
        $response = Citrus::response(1, null, $data);
        return $response;
    }



}