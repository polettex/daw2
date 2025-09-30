<?php

    $error = "";
    function ValidaCampoVacio($campo){
        //Comprobar que el campo usuario no esté vacío
        if(empty($campo)){
            //Variable vacía
            $error = true;
        }else{
            //Variable rellenada
            $error = false;
        }
        return $error;
    }
?>