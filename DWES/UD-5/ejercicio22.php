<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Email</title>
</head>

<body>
    <h1>Formulario de Confirmación de Email</h1>

    <form action="ejercicio22-resultado.php" method="post">
        <label for="email">Dirección de correo electrónico:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        
        <label for="confirm_email">Confirme su correo electrónico:</label>
        <input type="email" name="confirm_email" id="confirm_email" required>
        <br><br>
        
        <label>
            <input type="checkbox" name="publicidad" value="1">
            Acepto recibir publicidad
        </label>
        <br><br>
        
        <button type="submit">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
</body>

</html>
