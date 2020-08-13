<?php
function recorrido($caminos,$obstaculos){
    $posicion_robot= [0,0];
    $sseguimiento = 'yp';
    $hipof = 0;
    $hipo =0;
    $punto_maximo = [0,0];
    foreach ($caminos as $camino){
        switch ($sseguimiento) :
            case 'yp' :
                switch ($camino[0]) :
                    case 'm' :
                        $posicion_robot[1] += $camino[1];
                        foreach ($obstaculos as $obstaculo) {
                            if($obstaculo[1] <= $posicion_robot[1] && $obstaculo[0]== $posicion_robot[0]){
                                $posicion_robot[1] = ($obstaculo[1] -1);
                            }
                            $hipof = sqrt(pow($posicion_robot[0],2)+pow($posicion_robot[1],2));
                            if($hipof>$hipo){
                                $hipo = $hipof;
                                $punto_maximo[0] = $posicion_robot[0];
                                $punto_maximo[1] = $posicion_robot[1];
                            }
                        }
                        break;
                    case 'l' : $sseguimiento = 'xn';
                        break;
                    case 'r' : $sseguimiento = 'xp';
                endswitch;
                break;
            case 'yn' : switch ($camino[0]) :
                case 'm' : $posicion_robot[1] -= $camino[1];
                    foreach ($obstaculos as $obstaculo) {
                        if($obstaculo[1] >= $posicion_robot[1] && $obstaculo[0]== $posicion_robot[0]) {
                            $posicion_robot[1] = ($obstaculo[1] +1);
                        }
                        $hipof = sqrt(pow($posicion_robot[0],2)+pow($posicion_robot[1],2));
                        if($hipof>$hipo){
                            $hipo = $hipof;
                            $punto_maximo[0] = $posicion_robot[0];
                            $punto_maximo[1] = $posicion_robot[1];
                        }
                    }
                    break;
                case 'l' : $sseguimiento = 'xp';
                    break;
                case 'r' : $sseguimiento = 'xn';
                    break;
            endswitch;
                break;
            case 'xp' : switch ($camino[0]) :
                case 'm' : $posicion_robot[0] += $camino[1];
                    foreach ($obstaculos as $obstaculo) {
                        if($obstaculo[0] <= $posicion_robot[0] && $obstaculo[1]== $posicion_robot[1]) {
                            $posicion_robot[0] = ($obstaculo[0] -1);
                        }
                        $hipof = sqrt(pow($posicion_robot[0],2)+pow($posicion_robot[1],2));
                        if($hipof>$hipo){
                            $hipo = $hipof;
                            $punto_maximo[0] = $posicion_robot[0];
                            $punto_maximo[1] = $posicion_robot[1];
                        }
                    }
                    break;
                case 'l' : $sseguimiento = 'yp';
                    break;
                case 'r' : $sseguimiento = 'yn';
                    break;
            endswitch;
                break;
            case 'xn' : switch ($camino[0]) :
                case 'm' : $posicion_robot[0] -= $camino[1];
                    foreach ($obstaculos as $obstaculo) {
                        if($obstaculo[0] >= $posicion_robot[0] && $obstaculo[1]== $posicion_robot[1]) {
                            $posicion_robot[0] = ($obstaculo[0] +1);
                        }
                        $hipof = sqrt(pow($posicion_robot[0],2)+pow($posicion_robot[1],2));
                        if($hipof>$hipo){
                            $hipo = $hipof;
                            $punto_maximo[0] = $posicion_robot[0];
                            $punto_maximo[1] = $posicion_robot[1];
                        }
                    }
                    break;
                case 'l' : $sseguimiento = 'yn';
                    break;
                case 'r' : $sseguimiento = 'yp';
            endswitch;
        endswitch;
    }
    return [
        1=>$punto_maximo,
        2 => round($hipo,2)
    ];
}
    var_dump(recorrido([['m',5],['r'],['m',1],['l'],['m',3],['l'],['l'],['m',3]],[[0,2]]));