<?php

/**
 * @Author: Álvaro Escartí
 */

 session_start();
 
 include_once("./funciones.php");
 // Procesar el formulario de autenticación
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
     $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
     $perfil = isset($_POST["perfil"]) ? trim($_POST["perfil"]) : '';
 
     if ($nombre === '' || $perfil === '') {
         $mensaje = "Debe ingresar un nombre y seleccionar un perfil.";
     } else {
         $_SESSION['nombre'] = $nombre;
         $_SESSION['perfil'] = $perfil;
         header("Location: " . $perfil . ".php");
         exit();
     }
 }
 
 // Cerrar sesión
 if (isset($_GET['logout'])) {
     session_destroy();
     header("Location: index.php");
     exit();
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Formulario de Autenticación - Empresa XYZ</title>
 </head>
 <body>
     <h1>Formulario de Autenticación - Empresa XYZ</h1>
     <p>Por favor, ingrese su nombre y seleccione su perfil.</p>
 
     <?php if (isset($mensaje)): ?>
         <p style="color: red;"><?php echo htmlspecialchars($mensaje); ?></p>
     <?php endif; ?>
 
     <form method="POST" action="">
         <label for="nombre">Nombre:</label>
         <input type="text" id="nombre" name="nombre">
         <br><br>
         <label for="perfil">Perfil:</label>
         <select name="perfil" id="perfil">
             <option value="">--Selecciona un perfil--</option>
             <option value="gerente">Gerente</option>
             <option value="sindicalista">Sindicalista</option>
             <option value="nominas">Responsable de Nóminas</option>
         </select>
         <br><br>
         <input type="submit" name="login" value="Iniciar Sesión">
     </form>
 </body>
 </html>
