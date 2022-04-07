<?php

   @include 'config/config.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:auth/login.php');
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PAGINA DEL ADMIN</title>
   <link rel="stylesheet" href="css/style4.css">
</head>
<body>

   <section class="profile-container">

      <div class="profile">
         <h3>Bienvenido Admin</h3>
         <img src="images/apoyo.png">
         <h1><span><?php echo $_SESSION['admin_name'] ?></span></h1>
         <div class="linea"></div>
         <div class="flex-btn">
            <a href="admin_usuarios.php" class="option-btn1">Usuarios</a>
            <a href="admin_products.php" class="option-btn2">Paquetes</a>
         </div>
         <a href="auth/logout.php" class="delete-btn" id="logout__admin" >cerrar sesión</a>
      </div>

   </section>
   <script src="js/script.js"></script>

</body>
</html>