<?php

   @include '../config/config.php';

   session_start();

   if(isset($_POST['submit'])){

      $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $email = mysqli_real_escape_string($conn, $filter_email);
      $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
      $pass = mysqli_real_escape_string($conn, md5($filter_pass));

      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


      if(mysqli_num_rows($select_users) > 0){
         
         $row = mysqli_fetch_assoc($select_users);

         if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:../admin_page.php');

         }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:../cliente_page.php');

         }else{
            $message[] = 'no user found!';
         }

      }else{
         $message[] = 'incorrect email or password!';
      }

   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>inicio de sesión</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../css/auth.css">
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>

   <?php
      if(isset($message)){
         foreach($message as $message){
            echo '
            <div class="message">
               <span>'.$message.'</span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
   ?>


   <!--HEADER SECCION-->
   <header>
      <div id="menu-bar" class="fas fa-bars"></div>
      <a href= "#" class="logo"><img src="../images/loggo.png" alt="logo"></a>
      
      <nav class="navbar">
         <a href="../home.php">Inicio</a>
         <a href="../home.php #nosotros">Nosotros</a>
         <a href="../home.php #lugares__">Lugares</a>
         <a href="../contactos.php">Contactos</a>
      </nav>

      <div class= "icons">
         <a href="../home.php #registro__1"><i class="fas fa-user" id="login-btn"></i></a>
         <a class="ico">Registro</a>
      </div>
   </header>
      
   <section class="form-container">

      <form action="" method="post">
         <h3>Inicia sesión</h3>
         <div class="linea" id="linea"></div>
         <input type="email" name="email" class="box" placeholder="ingresa tu email" required>
         <input type="password" name="pass" class="box" placeholder="ingresa tu contraseña" required>
         <input type="submit" class="btn" name="submit" value="inicia sesión">
         <p>aun no tienes una cuenta? <a href="../home.php #registro__1">registrate ahora</a></p>
      </form>
   </section>
   
   <!-- FOOTER SECCIÓN-->
   <footer class="footer">
      <div class="box-container">
         <div class="box">
            <a href= "#" class="logo"><img src="../images/loggo.png" alt="logo"></a>
            <P>Siguenos en nuestras redes sociales</P>
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
         </div>

         <div class="box">
            <h3>Links</h3>
            <a href="../home.php" class="link"><i class="fas fa-arrow-right"></i>Home</a>
            <a href="../home.php #nosotros" class="link"><i class="fas fa-arrow-right"></i>Nosotros</a>
            <a href="../home.php #lugares__" class="link"><i class="fas fa-arrow-right"></i>Lugares</a>
            <a href="../contactos.php" class="link"><i class="fas fa-arrow-right"></i>Contactos</a>
         </div>

         <div class="box">
            <h3>Información de Contacto</h3>
            <p><i class="fa-solid fa-location-dot"></i>Cede: Trujillo, Venezuela</p>
            <p><i class="fas fa-phone"></i>+58 0426-1234567</p>
            <p><i class="fas fa-envelope"></i>ventour@gmail.com</p>
            <p><i class="fas fa-clock"></i>7:00am - 10:00pm</p>
         </div>
      </div>
      <h1 class="credit"> &copy; copyright @ <span id="year-home"></span> by Team. C.G.W.S </h1>
   </footer>
   <!-- FOOTER SECCIÓN-->
   <script src="../js/script2.js"></script>
</body>
</html>