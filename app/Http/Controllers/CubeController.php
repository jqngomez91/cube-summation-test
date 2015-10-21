<?php 

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use App\Helpers\Punto;

class CubeController extends Controller {

    public function summation(){
        $input = Request::input('entrada');
        

        $T = substr($input, 0,1); // N pruebas
        $N = substr($input, 3,1); // definicion Matriz
        $M = substr($input, 5,1); // Operaciones por hacer
        $O = str_replace("\r","|",substr($input, 7)); 
        $O = explode('|', $O);

        for($t = 0; $t < $T; $t++){
            $numPuntos = 0;
            for($m = 0; $m < $M; $m++){
                if(strpos($O[$m], "UPDATE") !== false){

                    $X = substr($O[$m], 8,1);
                    $Y = substr($O[$m], 10,1);
                    $Z = substr($O[$m], 12,1);
                    $W = substr($O[$m], 14);
                  
                    $punto = null;

                    for($i = 0; $i < $numPuntos; ++$i){
                        $p = $puntos[$i];

                        if($p->x == $X && $p->y == $Y && $p->z == $Z){
                            $punto=$p;
                        }
                    }

                    if($punto == null){
                        $punto = new Punto($X, $Y, $Z, $W);
                        $puntos[$numPuntos++] = $punto;
                      
                    }else{
                        $punto->w = $W;
                        $puntos[$i] = $punto;
                        
                    }

                }else if(strpos($O[$m], "QUERY") !== false){
                    
                    $X1 = substr($O[$m], 7,1);
                    $Y1 = substr($O[$m], 9,1);
                    $Z1 = substr($O[$m], 11,1);
                    $X2 = substr($O[$m], 13,1);
                    $Y2 = substr($O[$m], 15,1);
                    $Z2 = substr($O[$m], 17,1);
                    $W = 0;

                    for($i = 0; $i < $numPuntos; ++$i){
                        $p = $puntos[$i];
                        if ($p->x >= $X1 && $p->x <= $X2 && $p->y >= $Y1 && $p->y <= $Y2 && $p->z >= $Z1 && $p->z <= $Z2 ){
                            $W += $p->w;
                        }
                    }
                    echo "$W<br>";
                }
            }
        }

    }

}