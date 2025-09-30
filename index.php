<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Videojuegos</title>
</head>
<body>
    <form action="./validacion.php" method="POST">
        <!-- Input para usuario -->
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" size="25" placeholder="Introduce tu nombre de usuario" value="<?php if(isset($_GET['username'])) {echo $_GET['username'];} ?>">
        <br>
        <?php if(isset($_GET['usernameVacio'])) {echo "Debes rellenar obligatoriamente el campo username";} ?>
        <?php if(isset($_GET['usernameMal'])) {echo "El campo username contiene carácteres inválidos";} ?>
        <br>
        
        <!-- Input para email -->
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" size="25" placeholder="Introduce tu dirección de correo" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>">
        <br>
        <?php if(isset($_GET['emailVacio'])) {echo "Debes rellenar obligatoriamente el campo email";} ?>
        <?php if(isset($_GET['emailMal'])) {echo "El campo email contiene carácteres inválidos";} ?>
        <br>

        <!-- Ejemplo de abreviación -->
        <abbr title="obligatorio" aria-label="Este campo es obligatorio">*</abbr>
        
        <!-- Ejemplo de select -->
        <label for="tienda">Tienda:</label>
        <select name="tienda" id="tienda">
            <option value="" disabled <?php if(!isset($_GET['tienda'])) {echo "selected";} ?>>Selecciona una tienda</option>
            <option value="instant-gaming" <?php if(isset($_GET['tienda']) && $_GET['tienda']=="instant-gaming") {echo "selected";} ?>>Instant Gaming</option>
            <option value="game" <?php if(isset($_GET['tienda']) && $_GET['tienda']=="game") {echo "selected";} ?>>GAME</option>
            <option value="eneba" <?php if(isset($_GET['tienda']) && $_GET['tienda']=="eneba") {echo "selected";} ?>>Eneba</option>
            <option value="g2a" <?php if(isset($_GET['tienda']) && $_GET['tienda']=="g2a") {echo "selected";} ?>>G2A</option>
        </select>
        <br>
        <?php if(isset($_GET['tiendaVacia'])) {echo "Debes rellenar obligatoriamente la tienda";} ?>
        <br>

        <!-- Ejemplo de fieldset -->
         <fieldset id="juegos" style="max-width: 350px;">
            <legend for="juegos">Juegos de la tienda</legend>
            <!-- Ejemplo de checkbox -->
            <input type="checkbox" value="marioodyssey" name="juegos[]" id="juego1" <?php if(isset($_GET['juegos']) && is_array($_GET['juegos']) && in_array('marioodyssey', $_GET['juegos'])) {echo "checked";} ?>>
            <label for="juego1">Mario Odyssey</label>
            <br><br>
            <input type="checkbox" value="mariokart" name="juegos[]" id="juego2" <?php if(isset($_GET['juegos']) && is_array($_GET['juegos']) && in_array('mariokart', $_GET['juegos'])) {echo "checked";} ?>>
            <label for="juego2">Mario Kart</label>
            <br><br>
            <input type="checkbox" value="pokemonescarlata" name="juegos[]" id="juego3" <?php if(isset($_GET['juegos']) && is_array($_GET['juegos']) && in_array('pokemonescarlata', $_GET['juegos'])) {echo "checked";} ?>>
            <label for="juego3">Pokémon Escarlata</label>
            <br><br>
            <input type="checkbox" value="inazumaeleven" name="juegos[]" id="juego4" <?php if(isset($_GET['juegos']) && is_array($_GET['juegos']) && in_array('inazumaeleven', $_GET['juegos'])) {echo "checked";} ?>>
            <label for="juego4">Inazuma Eleven Victory Road</label>
            </fieldset>
        <?php if(isset($_GET['juegosVacio'])) {echo "Debes seleccionar al menos un juego";} ?>
        <br>

        <fieldset id="modalidad" style="max-width: 350px;">
            <legend for="modalidad">Modalidad de pago</legend>
            <!-- Ejemplo de radio -->
            <input type="radio" value="tarjeta" name="pago" id="tarjeta" <?php if(isset($_GET['pago']) && $_GET['pago']=="tarjeta") {echo "checked";} ?>>
            <label for="tarjeta">Tarjeta de crédito</label>
            <br>
            <input type="radio" value="transferencia" name="pago" id="transferencia" <?php if(isset($_GET['pago']) && $_GET['pago']=="transferencia") {echo "checked";} ?>>
            <label for="transferencia">Transferencia bancaria</label> 
            <br>
            <input type="radio" value="paypal" name="pago" id="paypal" <?php if(isset($_GET['pago']) && $_GET['pago']=="paypal") {echo "checked";} ?>>
            <label for="paypal">Paypal</label> 
        </fieldset>
        <?php if(isset($_GET['pagosVacio'])) {echo "Debes seleccionar una modalidad de pago";} ?>

        <!-- Ejemplo de textarea -->
        <br>
        <label for="observaciones">Observaciones</label>
        <br>
        <textarea name="observaciones" id="observaciones" rows="4" cols="50" style="max-width: 350px;" placeholder="Introduce alguna información importante de tu pedido"><?php if(isset($_GET['observaciones'])) {echo trim($_GET['observaciones']);} ?></textarea>
        
        <!-- Botón para enviar -->
         <br>
         <input type="submit" name="enviar" value="Realizar Pedido">
        </form>
</body>
</html>