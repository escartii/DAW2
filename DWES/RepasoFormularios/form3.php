<?php 
/**
 * @author Álvaro Escarti
 */

    function validaRequerido($valor){
        if(trim($valor) == ''){
            return false;
        }
        else{
            return true;
        }
    }

    function validarCheckboxes($valor) {
        return is_array($valor) && count($valor) > 0;
    }


    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
    $codigoPostal = isset($_POST["codigoPostal"]) ? $_POST["codigoPostal"] : null;
    $acepta = isset($_POST["acepta"]) ? $_POST["acepta"] : null;
    $pago = isset($_POST["pago"]) ? $_POST["pago"] : [];
    $horarioContacto = isset($_POST["horarioContacto"]) ? $_POST["horarioContacto"] : [];
    $contacto = isset($_POST["contacto"]) ? $_POST["contacto"] : [];
    $errores = array(); 

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (!validaRequerido($usuario)) {
            $errores[] = "El campo usuario es incorrecto.";
        }
        else{
            $link = "usuario=".$usuario."&";
        }
        if (!validaRequerido($password)) {
            $errores[] = "El campo password es incorrecto";
        }
        else{
            $link = $link."password=".$password."&";

        }

        if (!validaRequerido($nombre)) {
            $errores[] = "El campo nombre es incorrecto";
        }
        else{
            $link = $link."nombre=".$nombre."&";

        }

        if (!validaRequerido($email)) {
            $errores[] = "El campo email es incorrecto";
        }
        else{
            $link = $link."email=".$email."&";

        }

        if (!validaRequerido($telefono)) {
            $errores[] = "El campo telefono es incorrecto";
        }
        else{
            $link = $link."telefono=".$telefono."&";

        }

        if (!validaRequerido($direccion)) {
            $errores[] = "El campo direccion es incorrecto";
        }
        else{
            $link = $link."direccion=".$direccion."&";

        }

        if (!validaRequerido($codigoPostal)) {
            $errores[] = "El campo codigo postal es incorrecto";
        }
        else{
            $link = $link."codigoPostal=".$codigoPostal."&";

        }

        $arrayPago = ["Efectivo","Tarjeta","Transferencia","Contra reembolso"];

        if (!in_array($pago, $arrayPago)) {
            $errores[] = "El campo pago es incorrecto";
        }
        else{
            $link = $link."pago=".$pago."&";

        }

        if (!validarCheckboxes($horarioContacto)) {
            $errores[] = "El campo de Horarios de contacto es incorrecto";
        }
        else{
            $link = $link."horarioContacto=". implode(", ", $horarioContacto) ."&";
        }

        if (!validarCheckboxes($contacto)) {
            $errores[] = "El campo de contacto es incorrecto";
        }
        else{
            $link = $link."contacto=". implode(", ", $contacto) ."&";
        }
       
        if (!validarCheckboxes($acepta) && !isset($acepta)) {
            $errores[] = "El campo aceptar es incorrecto";
        }
        else{
            $link = $link."acepta=". $acepta  ."&";
        }
        
        if(!$errores){
            header("Location: aescarti.php?".$link);
            exit;
        }
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samuel Arteaga López</title>
</head>
<body>
    <?php if ($errores): ?>
        <ul style="color: #f00;">
        <?php foreach ($errores as $error): ?>
        <li> <?php echo $error ?> </li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <form action="form3.php" method="post" enctype="multipart/form-data">
        <label for="usuario">Usuario:</label><br><br>
        <input type="text" name="usuario"><br><br>

        <label for="password">Contraseña:</label><br><br>
        <input type="password" name="password"><br><br>

        <label for="nombre">Nombre:</label><br><br>
        <input type="text" name="nombre"><br><br>

        <label for="email">Correo:</label><br><br>
        <input type="text" name="email"><br><br>

        <label for="telefono">Teléfono:</label><br><br>
        <input type="tel" name="telefono"><br><br>

        <label for="direccion">Dirección:</label><br><br>
        <input type="text" name="direccion"><br><br>

        <label for="codigoPostal">Código Postal :</label><br><br>
        <input type="text" name="codigoPostal"><br><br>

        <label for="yaRegistrado">¿Estaba ya registrado?</label><br><br>
        <input type="radio" name="yaRegistrado" value="Ya estoy registrado">Ya estoy registrado
        <input type="radio" name="yaRegistrado" value="Soy un nuevo usuario ">Soy nuevo usuario<br><br>

        <input type="checkbox" name="acepta" <?php echo ($acepta == "acepta") ? "selected" : ""?> >Acepto la LOPDGDD<br><br>

        <label for="horarioContacto">Horario de Contacto</label>
        <select multiple name="horarioContacto[]">
        <option value="8-12" <?php echo in_array("8-12", $horarioContacto) ? "selected" : ""?> >8-12</option>
        <option value="10-14" <?php echo in_array("10-14", $horarioContacto) ? "selected" : ""?> >10-14</option>
        <option value="12-16" <?php echo in_array("12-16", $horarioContacto) ? "selected" : ""?> >12-16</option>
        <option value="14-18" <?php echo in_array("14-18", $horarioContacto) ? "selected" : ""?> >14-18</option>
        <option value="16-20" <?php echo in_array("16-20", $horarioContacto) ? "selected" : ""?> >16-20</option>
        <option value="18-22" <?php echo in_array("18-22", $horarioContacto) ? "selected" : ""?> >18-22</option>
        <option value="20-22" <?php echo in_array("20-22", $horarioContacto) ? "selected" : ""?> >20-22</option>
        </select><br><br>

        <label for="contacto">Preferencias de Contacto</label>
        <select multiple name="contacto[]">
        <option value="Teléfono" <?php echo in_array("Teléfono", $contacto) ? "selected" : ""?> >Teléfono</option>
        <option value="Email" <?php echo in_array("Email", $contacto) ? "selected" : ""?> >Email</option>
        <option value="SMS" <?php echo in_array("SMS", $contacto) ? "selected" : ""?> >SMS</option>
        <option value="Whatsapp/Telegram" <?php echo in_array("Whatsapp/Telegram", $contacto) ? "selected" : ""?> >Whatsapp/Telegram</option>
        </select><br><br>

        <label for="pago">Opciones de pago</label>
        <select name="pago">
        <option value="Efectivo" <?php echo ($pago == "Efectivo") ? "selected" : ""?>>Efectivo</option>
        <option value="Tarjeta" <?php echo ($pago == "Tarjeta") ? "selected" : ""?>>Tarjeta</option>
        <option value="Transferencia" <?php echo ($pago == "Transferencia") ? "selected" : ""?>>Transferencia</option>
        <option value="Contra reembolso" <?php echo ($pago == "Contra reembolso") ? "selected" : ""?>>Contra reembolso</option>
        </select><br><br>

        <input type="reset" value="Borrar">
        <input type="submit" value="Enviar"><br><br>

    </form>
</body>
</html>