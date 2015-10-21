<?php 

namespace App\Http\Controllers;
use Request;
use App\Http\Controllers\Controller;

class CubeController extends Controller {

    public function summation(){
        $input = Request::input('entrada');
        //print_r($input);
        return $input;
    }

}