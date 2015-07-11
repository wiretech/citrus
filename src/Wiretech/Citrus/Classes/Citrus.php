<?php
namespace Wiretech\Citrus\Classes;

class Citrus {

    /*
    |----------------------------------------
    | Construct the Citrus Object
    |----------------------------------------
    |
    */
    public function __construct()
    {
        $this->success = null;
    }

    /*
    |----------------------------------------
    | The response() function of Citrus
    |----------------------------------------
    |
    | This function initializes a citrus object and sets the success
    | the success switch to either 'data' or 'error' and can be parsed
    | like this
    |
    |   $data = Citrus::response();
    |   $key = $data->success;
    |   $data = $data->$key;
    |
    */

    public static function response($success = 'error', $data = null)
    {
        $citrus = new Citrus;
        $citrus->success = $success;
        $citrus->$success = $data;
        return json_encode($citrus);
    }

    /*
    |----------------------------------------
    | The build() function for Citrus
    |----------------------------------------
    |
    */

    private static function build($array)
    {
        $data = array();

        foreach ($array as $index => $value) {

           $data[$index] = json_decode(json_encode($value));
        }

        return $data;
    }

    /*
    |----------------------------------------
    | The combine() function for Citrus
    |----------------------------------------
    |
    | This function builds each string argument and object argument pair
    | into an array and then parses it using response()
    |
    */
    
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
        $response = Citrus::response('data', $data);
        return $response;
    }
}
