<?php 

namespace Wiretech\Citrus;

class Citrus {

    protected $cache;

    public function response($success = 0, $error = 'An unkown error occured', $data = null)
    {

        $response['success'] = $success;
        $response['error'] = $error;
        # getting rid of cache, cache is never to be sent from server to client
        //$response['cache'] = \Config::get('citrus::cache');
        $response['data'] = $this->recursivelyApplyObject($data);

        return $response;
    }

    /**
     * This method will recursively iterate through the data given, and for each object found it will resolve that 
     * object's properties into the multidimensional data array 
     * @param Data given in the response method
     * @return array if array given and object if object given.. null if error occurs 
     */
    private function recursivelyApplyObject($data)
    {
        if (is_object($data)) {
            if (method_exists($data, 'returnData')) {
                return $data->returnData();
            }
            return $this->defaultObjectReturn($data);
        }
        else
        {
            if (is_array($data)) {
                #iterate through the array and recursively call this method on the individual objects
                $new_data = array();

                foreach ($data as $key=>$data_object) {
                    $data_object = $this->recursivelyApplyObject($data_object);
                    $new_data[$key] = $data_object;
                }

                return $new_data;
            }

            # they have not sent an array or object, so we can't really help them here, just return what was sent
            return $data;
        }
    }

    /**
     * returns all the properties and values of this object as a key value pair in the return array
     * @param data sent in Citrus response method
     * @return array of data
     */
    private function defaultObjectReturn($data)
    {
        return get_object_vars($data);
    }

    private  function build($array)
    {
        $data = array();

        foreach ($array as $index => $value) {

           $data[$index] = json_decode(json_encode($value), true);
        }

        return $data;
    }

    public function combine()
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
 
        $data = $this->build($array);
        $response = $this->response(1, null, $data);
        return $response;
    }



}
