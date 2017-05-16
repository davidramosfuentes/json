<?php
$opera="";$warn="";$crit="";
//$str_datos = file_get_contents('http://www.unarutacualquiera.com'); // abrir fichero atravez de una url
$str_datos = file_get_contents("estado.json"); // abrir fichero misma carpeta
$datos = json_decode($str_datos,true); //decodificar el json
        foreach ($datos as $datos) {
          if ($datos == ""){//prueba de fallos
          break;
          }
          if (in_array("UP", $datos)){//comprobbacion de primer nivel
            $opera.=json_encode($datos)."\n";
            if (array_key_exists('propertySources', $datos)){
                foreach(range(4, 5) as $depth) {//recorrer la profundida
                    print_r(json_decode(json_encode($datos), true, $depth));
                        if (in_array("UP", $datos)){
                        $opera.=json_encode($datos)."\n";
                        }elseif (in_array("WARN", $datos)) {
                        $warn.=json_encode($datos)."\n";
                        }elseif (in_array("CRIT", $datos)) {
                          $crit.=json_encode($datos)."\n";
                        }
                  }
                }
              }elseif (in_array("WARN", $datos)) {
                $warn.=json_encode($datos)."\n";
              }
              elseif (in_array("CRIT", $datos)) {
              $crit.=json_encode($datos)."\n";
            }else{
              echo "no ha arrancado el supervisord";
            }
        }
print_r($opera);
echo "\n";
print_r($warn);
echo "\n";
print_r($crit);
echo "\n";

 ?>
