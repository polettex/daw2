<?php
    //SI VENGO DE RECEPCION
    if(filter_has_var(INPUT_POST,'pedidook')){
        session_start();
        
        $_SESSION['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $_SESSION['tienda'] = isset($_POST['tienda']) ? $_POST['tienda'] : '';
        $_SESSION['juegos'] = isset($_POST['juegos']) ? $_POST['juegos'] : array();
        $_SESSION['pago'] = isset($_POST['pago']) ? $_POST['pago'] : '';
        $_SESSION['observaciones'] = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        header("Location: ./pago1.php");
        exit();
    }
    
    // SI VENGO DE INDEX
    if(!filter_has_var(INPUT_POST,'enviar')){
        //SI NO VENGO DE INDEX, VOLVER A INDEX
        header("Location: ./index.php");
        exit();
    }else{
        $errores = "";
        $username=$_POST['username'];
        $email=$_POST['email'];
        $observaciones=$_POST['observaciones'];
    }    
    //TIENDA
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
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            // No cumple el patrón
            if (!$errores) {
                $errores .= "?usernameMal=true";
            } else {
                $errores .= "&usernameMal=true";
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
        echo "<form id='enviocheck' action='recepcion.php' method='post'>";
        echo "<input type='hidden' name='username' value='$username'>";
        echo "<input type='hidden' name='email' value='$email'>";
        $juego="";
        foreach ($juegos as $juego) {
            echo "<input type='hidden' name='juegos[]' value='$juego'>";
        }
        echo "<input type='hidden' name='pago' value='$pago'>";
        echo "<input type='hidden' name='observaciones' value='$observaciones'>";
        echo "<input type='hidden' name='tienda' value='$tienda'>";
        echo "</form>";
        echo "<script>document.getElementById('enviocheck').submit();</script>";
    }
?>