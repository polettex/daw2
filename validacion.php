<?php
    if(!filter_has_var(INPUT_POST,'enviar')){
        header("Location: ./index.php");
        exit();
    }else{
        $errores = "";
        $username=$_POST['username'];
        $email=$_POST['email'];
        $observaciones=$_POST['observaciones'];
        if(isset($_POST['tienda'])){
            $tienda=$_POST['tienda'];
        }else{
            if(!$errores){
                $errores .="?tiendaVacia=true";
            }else{
                $errores .="&tiendaVacia=true";
            }
        }

        //JUEGOS
        if(filter_has_var(INPUT_POST,'juegos')){
            $juegos=$_POST['juegos'];
        }else{
            if(!$errores){
                $errores .="?juegosVacio=true";
            }else{
                $errores .="&juegosVacio=true";
            }
        }

        //PAGO
        if(filter_has_var(INPUT_POST,'pago')){
            $juegos=$_POST['pago'];
        }else{
            if(!$errores){
                $errores .="?pagosVacio=true";
            }else{
                $errores .="&pagosVacio=true";
            }
        }
        
        require_once("./funciones.php");
        if(ValidaCampoVacio($username)){
            // Está vacío
            if(!$errores){
                $errores .="?usernameVacio=true";
            }else{
                $errores .="&usernameVacio=true";
            }
        }else{
            // Está relleno
            if(!preg_grep("/^[a-zA-Z0-9]*$/",$username)){
                // No cumple el patrón
                if(!$errores){
                    $errores .="?usernameMal=true";
                }else{
                    $errores .="&usernameMal=true";
                }
            }
        }

        //EMAIL
        if(ValidaCampoVacio($email)){
            // Está vacío
            if(!$errores){
                $errores .="?emailVacio=true";
            }else{
                $errores .="&emailVacio=true";
            }
        }else{
            // Está relleno
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                // No es un email válido
                if(!$errores){
                    $errores .="?emailMal=true";
                }else{
                    $errores .="&emailMal=true";
                }
            }
        }

        if($errores!=""){
            // VOLVER A INDEX Y PASAR VARIABLES RECIBIDAS + ERRORES
            $datosRecibidos = array(
                'username' => $username,
                'email' => $email,
                'observaciones' => $observaciones,
                'juegos' => $juegos,
                'tienda' => $tienda,
                'pago' => $pago
            );
            $datosDevueltos = http_build_query($datosRecibidos);
            header("Location: ./index.php".$errores."&".$datosDevueltos);
            exit();
        }else{
            //IR A LA PÁGINA DE CHECK
            echo "<form action='recepcion.php' method='post'>";
            echo "<input type='hidden' name='username' value='".$username."'>";
            echo "<input type='hidden' name='email' value='".$email."'>";
            echo "<input type='hidden' name='observaciones' value='".$observaciones."'>";
            $juego="";
            foreach($juegos as $juego){
                echo "<input type='hidden' name='juegos[]' value='".$juego."'>";
            }
            echo "<input type='hidden' name='tienda' value='".$tienda."'>";
            echo "<input type='hidden' name='pago' value='".$pago."'>";
            echo "</form>";
            echo "<script>document.getElementById('EnvioCheck').submit();</script>";
        }

    }
?>