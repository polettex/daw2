<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcion</title>
</head>
<body>
    <?php
        $username=$_POST['username'];
        echo "Bienvenido " .$username."<br>";
        $email=$_POST['email'];
        echo "Correo: " .$email."<br>";
        $tienda=$_POST['tienda'];
        echo "Tienda: " .$tienda."<br>";
        

        if (isset($_POST['juegos'])) {
            $juegos=$_POST['juegos'];
            echo "Juegos seleccionados por el usuario ".$username."; <br>";
            foreach ($juegos as $juego) {
                echo $juego."<br>";
            }
        }
        
        $pago=$_POST['pago'];
        echo "Método de pago: ". $pago . "<br>";
        $observaciones=$_POST['observaciones'];
        echo "Observaciones a tener en cuenta: " . $observaciones . "<br>";
    ?>

    <form action="./index.php" method="GET">
        <input type="hidden" id="username" name="username" value="<?php echo $username ?>">
        <input type="hidden" id="email" name="email" value="<?php echo $email ?>">
        <input type="hidden" id="tienda" name="tienda" value="<?php echo $tienda ?>">
        <?php 
            if (isset($_POST['juegos'])) {
                foreach ($juegos as $juego) {
                    echo '<input type="hidden" name="juegos[]" value="'.$juego.'">';
                }
            }
        ?>

        <input type="hidden" id="pago" name="pago" value="<?php echo $pago ?>">
        <input type="hidden" id="observaciones" name="observaciones" value="<?php echo $observaciones ?>">
        <input type="submit" value="Modificar pedido">
    </form>

    <!-- Realizar pedido -->

    <form action="./validacion.php" method="POST">
        <input type="hidden" id="pedidook" name="pedidook" value="pedidook">
        <input type="hidden" id="username" name="username" value="<?php echo $username ?>">
        <input type="hidden" id="email" name="email" value="<?php echo $email ?>">
        <input type="hidden" id="tienda" name="tienda" value="<?php echo $tienda ?>">
        <?php 
            if (isset($_POST['juegos'])) {
                foreach ($juegos as $juego) {
                    echo '<input type="hidden" name="juegos[]" value="'.$juego.'">';
                }
            }
        ?>

        <input type="hidden" id="pago" name="pago" value="<?php echo $pago ?>">
        <input type="hidden" id="observaciones" name="observaciones" value="<?php echo $observaciones ?>">
        <input type="submit" value="Realizar pedido">
    </form>        
</body>
</html>