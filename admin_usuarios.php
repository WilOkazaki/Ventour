<?php

@include 'config/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:auth/login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN USUARIOS</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <header>
      <div id="menu-bar" class="fas fa-bars"></div>
      <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
            
      <nav class="navbar">
         <a href="admin_page.php">Inicio</a>
         <a href="admin_usuarios.php">Usuarios</a>
         <a href="admin_products.php">Paquetes</a>
      </nav>
      <div class= "icons">
         <a href="auth/logout.php"><i class="fas fa-user" id="login-btn"></i></a>
         <a class="ico">Cerrar sesión</a>
      </div>
   </header>

   <section class="user_2"> 
      <h2>Cuentas de Usuarios</h2>
      <div class="linea"></div>
   </section>

   <section class="users">
      <div class="box-container">
         <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            if(mysqli_num_rows($select_users) > 0){
               while($fetch_users = mysqli_fetch_assoc($select_users)){
         ?>
         <div class="box">
            <p>Id Usuario : <span><?php echo $fetch_users['id']; ?></span></p>
            <p>Nombre : <span><?php echo $fetch_users['name']; ?></span></p>
            <p>Correo : <span><?php echo $fetch_users['email']; ?></span></p>
            <p>Tipo de usuario : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
            <a href="admin_usuarios.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Desea eliminar el usuario?');" class="delete-btn">delete</a>
         </div>
         <?php
            }
         }
         ?>
      </div>
   </section>

   <script src="js/script2.js"></script>
</body>
</html>










