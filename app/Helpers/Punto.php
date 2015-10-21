<?php 

namespace App\Helpers;

class Punto{
	public $w;
    public $x;
    public $y;
    public $z;

	function __construct($x, $y, $z, $w){
	    $this->x = $x;
	    $this->y = $y;
	    $this->z = $z;
	    $this->w = $w;
    }

    function get(){
    	return 'x: '.$this->x.' y: '.$this->y.' z: '. $this->z;
    }
}