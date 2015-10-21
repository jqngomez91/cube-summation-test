<?php 

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use App\Helpers\Punto;

class CubeController extends Controller {

    public function summation(){
        $input = Request::input('entrada');
        

        $T = substr($input, 0,1); // N pruebas
        $O = str_replace("\r","|",substr($input, 2)); 
        $O = explode('|', $O);
        $pos = 0;


        for($t = 0; $t < $T; $t++){
            $puntos = null;
            $numPuntos = 0;
            $N = substr($O[$pos], 1,1); // definicion Matriz
            $M = substr($O[$pos], 3,1); // Operaciones por hacer
            
            //echo "-$M";
            //$pos++;
            for($m = 0; $m <= $M; $m++){
                //echo "Valor: $m<br>";
                
                if(strpos($O[$pos], "UPDATE") !== false){
                    //echo $O[$m]." <br>";
                    $X = substr($O[$pos], 8,1);
                    $Y = substr($O[$pos], 10,1);
                    $Z = substr($O[$pos], 12,1);
                    $W = substr($O[$pos], 14);
                  
                    $punto = null;

                    for($i = 0; $i < $numPuntos; ++$i){
                        $p = $puntos[$i];
                        if($p->x == $X && $p->y == $Y && $p->z == $Z){
                            $punto=$p;
                        }
                    }

                    if($punto == null){
                        $puntos[$numPuntos++] = $punto = new Punto($X, $Y, $Z, $W);
                    }else{
                        $punto->w = $W;
                        $puntos[$i] = $punto;
                    }

                }else if(strpos($O[$pos], "QUERY") !== false){

                    $X1 = substr($O[$pos], 7,1);
                    $Y1 = substr($O[$pos], 9,1);
                    $Z1 = substr($O[$pos], 11,1);
                    $X2 = substr($O[$pos], 13,1);
                    $Y2 = substr($O[$pos], 15,1);
                    $Z2 = substr($O[$pos], 17,1);
                    $W = 0;

                    for($i = 0; $i < $numPuntos; ++$i){
                        $p = $puntos[$i];
                        if ($p->x >= $X1 && $p->x <= $X2 && $p->y >= $Y1 && $p->y <= $Y2 && $p->z >= $Z1 && $p->z <= $Z2){
                            $W +=$p->w;
                        }
                    }

                    echo "$W<br>";
                }
                $pos++;
            }
        }

    }

}