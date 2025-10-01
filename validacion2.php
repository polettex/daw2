<?php
if(filter_has_var(INPUT_POST, 'pedido')){
 session_start();

 $_SESSION['username']= isset ($_POST['username']) ? $_POST['username'] : '';
 $_SESSION['email']= isset ($_POST['email']) ? $_POST['email'] : '';
 $_SESSION['juegos']= isset ($_POST['juegos']) ? $_POST['juegos'] : array();
 $_SESSION['pago']= isset ($_POST['pago']) ? $_POST['pago'] : '';
 $_SESSION['observaciones']= isset ($_POST['observaciones']) ? $_POST['observaciones'] : '';
 $_SESSION['tienda']= isset ($_POST['tienda']) ? $_POST['tienda'] : '';
 header('Location: ./pago1.php');
 exit();    


}


if(!filter_has_var(INPUT_POST, 'submit')){
    header('Location: ./index.php');
    exit();
}else{
    $errores="";
    $username= $_POST['username'];
    $email= $_POST['email'];
    $observaciones= $_POST['observaciones'];
}
if(isset($_POST['tienda'])){
    $tienda= $_POST['tienda'];
}else{
    if(!$errores){
        $errores="?tiendaVacio=true";
}else{
    $errores=$errores.="&tiendaVacio=true";
}

} 
if(filter_has_var(INPUT_POST,'juegos')){
    if(!$errores){
        $errores.="?juegosVacio=true";
    }else{
        $errores.="&juegosVacio=true";
    }
}
if(filter_has_var(INPUT_POST,'pago')){
    if(!$errores){
        $errores.="?pagoVacio=true";
    }else{
        $errores.="&pagoVacio=true";
    }
}
require_once 'funciones.php';
if (validacampovacio($username)){
    if(!$errores){
        $errores.="?usernameVacio=true";
    }else{
        $errores.="&usernameVacio=true";
    }

}else{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){;
    if(!$errores){
        $errores.="?usernameMal=true";
    }else{
        $errores.="&usernameMal=true";
    }
}
}
if (validacampovacio($email)){
    if(!$errores){
        $errores.="?emailVacio=true";
    }else{
        $errores.="&emailVacio=true";
    }

}else{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    if(!$errores){
        $errores.="?emailMal=true";
    }else{
        $errores.="&emailMal=true";
    }
}
}
if ($errores!=""){
    $datosrecibidos = array(
        'username' => $username,
        'email' => $email,
        'juegos' => $juegos,
        'pago' => $pago,
        'observaciones' => $observaciones,
        'tienda' => $tienda
    );
    $datosDevueltos = http_build_query($datosrecibidos);
   header('Location: ./index.php'.$errores.'&'.$datosDevueltos);
    exit(); 

}else{
    echo "<form id='enviocheck' action='check.php' method='post'>";
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