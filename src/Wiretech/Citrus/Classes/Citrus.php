<?php
namespace Wiretech\Citrus\Classes;

class Citrus {

    protected $cache;

    public static function response($success = 0, $error = 'An unkown error occured', $data = null)
    {
        $response['success'] = $success;
        $response['error'] = $error;
        //$response['cache'] = \Config::get('citrus::cache');
        $response['data'] = $data;        

        return json_encode($response);
    }

    private static function build($array)
    {
        $data = array();

        foreach ($array as $index => $value) {

           $data[$index] = json_decode(json_encode($value), true);
        }

        return $data;
    }

    public static function combine()
    {
        $data = array();
 
        $args = func_num_args();
 
        $argDecider = 0;

        for ($i=0; $i < $args/2; $i++) { 
            
            $index = func_get_arg($argDecider);
            $object = func_get_arg($argDecider + 1);

            $array[$index] = $object;
            
            $argDecider = $argDecider + 2;
         }
 
        $data = Citrus::build($array);
        $response = Citrus::response(1, null, $data);
        return $response;
    }



}
