<?php
    $arreglo = array(1,2,3,4,"Texto",true);
    print_r($arreglo);
    echo "</br>";
    
    $arreglo2= array("nombre"=>"Fulano","apellido"=>"Detal","edad"=>20);
    print_r($arreglo2);
    echo "</br>";
    
    $arreglo2[]= "Esto no tiene llave";
    
    $arreglo2["titulo"]= "Sir";
    print_r($arreglo2);
    
    $personas[]=array();
    $personas[]=$arreglo2;
    $personas[]=$arreglo;
    
    
    $arreglo2["locura"]=$personas;
    $personas["3"]=$arreglo2;
    echo "</br>";
    echo "</br>";
    echo "</br>";
    print_r($personas);
    
    echo "</br>";
    echo "</br>";
    foreach($personas as $key => $value){
        echo "$key -> ";
        if(is_array($value)){
            foreach($value as $key2 => $value2){
            echo "</br>............$key2 -> $value2";
    }
        }else{
            echo $value;
        }
    }
?>