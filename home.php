<?php

@include 'config/config.php';


if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'el usuario ya existe';
   }else{
      if($pass != $cpass){
         $message[] = 'no se pudo confirmar tu contraseña';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registro exitoso!';
         header('location:auth/login.php');
      }
   }

}

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/style2.css">
   <link rel="stylesheet" href="css/auth.css">

   <title>VENTUOR</title>
</head>

<body>
   <!--HEADER SECCIOÓN-->
   <header>
      <div id="menu-bar" class="fas fa-bars"></div>
      <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
      
      <nav class="navbar">
         <a href="home.php">Inicio</a>
         <a href="#nosotros">Nosotros</a>
         <a href="#lugares__">Lugares</a>
         <a href="contactos.php">Contactos</a>
         <a href="#registro__1">Registro</a>
      </nav>
		<div class= "icons">
         <a href="auth/login.php"><i class="fas fa-user" id="login-btn"></i></a>
         <a class="ico">inicia sesión</a>
      </div>
   </header>
   <!--HEADER SECCIÓN-->

   <!--HOME SECCIÓN-->
   <section class="home">
      <div class="content">
         <h3>Disfruta lo Hermoso de Venezuela</h3>
         <p>¡Conocerla es tu Destino!</p>
      </div>

      <div class="controls">
         <span class="vid-btn active" data-src="images/vid-01.mp4"></span>
         <span class="vid-btn" data-src="images/vid-2.mp4"></span>
         <span class="vid-btn" data-src="images/vid-6.mp4"></span>
         <span class="vid-btn" data-src="images/vid-7.mp4"></span>
      </div>

      <div class="video-container">
         <video src="images/vid-01.mp4" id="video-slider" loop autoplay muted></video>
      </div>
   </section>
   <!--HOME SECCIÓN-->

   <!--NOSOTROS SECCIÓN-->
   <section class="nos" id="nosotros"> 
      <h2 class="title-n">SOBRE NOSOTROS</h2> 
      <div class="linea"></div> 

      <section class="home-about"> 
         <div class="image"> 
            <img src="images/saltoangel.jpg" alt="salto"> 
         </div> 

         <div class="content"> 
            <h1>VEN TOUR</h1> 
            <div class="linea"></div> 
               <p>Somos un operador de turismo receptivo en Venezuela que gracias a su experiencia y conocimiento tanto de los destinos, como de sus alianzas estratégicas con hoteles y aerolíneas; le puede garantizar los mejores servicios y la mejor atención para sus Clientes.</p> 
               <p>VEN Tour está estratégicamente aliado a empresas claves, fortaleciendo de esta manera la calidad de los servicios a precios altamente competitivos en el área de turismo para garantizar variedad y calidad de los servicios en Venezuela.</p> 
               <a href="contactos.php" class="btn_2">Contactanos</a> 
         </div> 
      </section> 
   </section>

   <section class="nosotros" data-aos="fade-down">
      <div class="box-container">
         <div class="box">
            <div class="ima">
               <img src="images/v.png" alt="v">
            </div>

            <div class="content">
               <h3>Misión</h3>
               <p>Ofrecer calidad, seguridad y tecnología en los servicios de turismo, viajes, convenciones y eventos, satisfaciendo las necesidades de nuestros clientes, siendo una organización de vanguardia a nivel nacional e internacional apoyándonos en nuestro recurso humano y en el mejoramiento continuo en la calidad de los procesos</p>
            </div>
         </div>

         <div class="box">
            <div class="ima">
               <img src="images/vv.png" alt="v">
            </div>

            <div class="content">
               <h3>Visión</h3>
               <p>Posicionarnos en el mercado, como una de las más prestigiosas empresas de Viajes, Turismo, Agencia Virtual, líder de servicios en Venezuela, haciéndolo posible mediante el esfuerzo, innovación, tecnología y mejoramiento continuo. Responder a las exigencias, necesidades y desafíos del entorno global cambiante; de tal manera que asegure nuestro éxito en el tiempo.</p>
            </div>
         </div>   
      </div>
   </section>
   <!--NOSOTROS SECCIÓN-->

   <!--SERVICIOS SECCIÓN-->
   <section class="services">

      <h1 class="heading-title2"> nuestros servicios </h1>
      <div class="linea"></div>

      <div class="box-container2">

         <div class="box2">
            <img src="images/hotel.png" alt="">
            <h3>Hoteleria</h3>
         </div>

         <div class="box2">
            <img src="images/image (2).png" alt="">
            <h3>Guía</h3>
         </div>

         <div class="box2">
            <img src="images/bus.png" alt="">
            <h3>transporte</h3>
         </div>

         <div class="box2">
            <img src="images/restaurant.png" alt="">
            <h3>restaurant</h3>
         </div>

         <div class="box2">
            <img src="images/seguridad.png" alt="">
            <h3>seguridad</h3>
         </div>

      </div>

   </section>
   <!--sERVICIOS SECCIÓN-->

   <!--VALORES SECCIÓN-->
   <section class="valores">
      <h3>nuestros Valores</h3>
      <div class="linea" id="linea"></div>

      <div class="row-container">
         <div class="row">
            <i class="fa-solid fa-user-check"></i>
            <p>Calidad de Servicio</p>
         </div>
         <div class="row">
            <i class="fa-solid fa-leaf"></i>
            <p>Conservación de la naturaleza</p>
         </div>
         <div class="row">
            <i class="fa-solid fa-people-group"></i>
            <p>Trabajo en equipo</p>
         </div>
      </div>

      <div class="row-container">
         <div class="row">
            <i class="fa-solid fa-handshake"></i>
            <p>Ética</p>
         </div>   
         <div class="row">
            <i class="fa-solid fa-users-gear"></i>
            <p>Responsabilidad</p>
         </div>
      </div>
   </section>
   <!--VALORES SECCIÓN-->

   <!-- LUGARES TURÍSTICOs SECCIÓN-->
   <section class="lugares" id="lugares__" >
      <h1> lugares turísticos de 
         <span class="ven"><span class="t1">ven</span><span class="t2">ezu</span><span class="t3">ela</span></span>
      </h1>
      <div class="linea"></div>

      <h2 class="text">
         <span>m</span><span>é</span><span>r</span><span>i</span><span>d</span><span>a</span>
      </h2>

      <div class="box-container">
         <div class="box">
            <img src="images/merida-1.jpg" alt="Laguna Mucubaji">
            <div class="cont">
               <h3>Laguna de Mucubají</h3>
               <p>Un lugar maravilloso lleno de energia positiva, espectacular vista</p>
            </div>
         </div>
         <div class="box">
            <img src="images/merida-2.jpg" alt="Teleférico">
            <div class="cont">
               <h3>Teleférico de Mérida</h3>
               <p>El teleférico más alto del mundo, nuestro teleferico Mérida Venezuela.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/merida-3.jpg" alt="Agua Termales Musui">
            <div class="cont">
               <h3>Agua Termales Musui</h3>
               <p> Un verdadero oasis de paz, rodeado de hermosos paisajes.</p>
            </div>
         </div> 
      </div>

      <h2 class="text">
         <span>f</span><span>a</span><span>l</span><span>c</span><span>ó</span><span>n</span>
      </h2>
      <div class="box-container">
         <div class="box">
            <img src="images/falcon-1.jpg" alt="Los Médanos de Coro">
            <div class="cont">
               <h3>Los Médanos de Coro</h3>
               <p>La experiencia inolvidable de visitar un desierto te da Venezuela.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/falcon-2.jpg" alt="Cueva de la Quebrada del Toro">
            <div class="cont">
               <h3>Cueva de la Quebrada del Toro</h3>
               <p>te da la oportunidad de sumergirte en los interiores de una formación rocosa llena de fauna misteriosa.</p>
            </div>
         </div>
            
         <div class="box">
            <img src="images/falcon-3.jpg" alt="Cayo Sombrero">
            <div class="cont">
               <h3>Cayo Sombrero</h3>
               <p> Esta pequeña isla es conocida por mezclar lo más delicioso de las paradisíacas playas del caribe.</p>
            </div>
         </div> 
      </div>

      <h2 class="text">
         <span>s</span><span>u</span><span>c</span><span>r</span><span>e</span>
      </h2>
      <div class="box-container">
         <div class="box">
            <img src="images/sucre-1.jpg" alt="Playa Rosada">
            <div class="cont">
               <h3>Playa Rosada</h3>
               <p>Se caracteriza por sus tonalidades que van del rojizo al dorado y por sus aguas cristalinas, sus cocoteros y su rica fauna.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/sucre-2.jpg" alt="Cueva del Fantasma">
            <div class="cont">
               <h3>Cueva del Fantasma</h3>
               <p>te da la oportunidad de sumergirte en los interiores de una formación rocosa llena de fauna misteriosa.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/sucre-3.jpg" alt="Agua de Moisés">
            <div class="cont">
               <h3>Agua de Moisés</h3>
               <p>Un magnífico lugar donde podrá relajarse dentro de las maravillosas aguas termales y descansar disfrutando del idílico panorama.</p>
            </div>
         </div> 
      </div>

      <h2 class="text">
         <span>b</span><span>o</span><span>l</span><span>i</span><span>v</span><span>a</span><span>r</span>
      </h2>
      <div class="box-container">
         <div class="box">
            <img src="images/bolivar-1.jpg" alt="Salto Ángel">
            <div class="cont">
               <h3>Salto Ángel</h3>
               <p>Disfruta de la cascada mas alta del mundo en Venezuela con sus hermosos paisajes.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/bolivar-2.jpg" alt="Los Jacuzzis del Roraima">
            <div class="cont">
               <h3>Los Jacuzzis del Roraima</h3>
               <p>En los más antiguos del mundo. También podemos decir que son de aguas cristalinas depositadas en una cavidad en forma de jacuzzis pero naturales.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/bolivar-3.jpg" alt="Cueva del Fantasma">
            <div class="cont">
               <h3>Cueva del Fantasma</h3>
               <p>Tiene una hermosa grieta donde cae una cascada al costado de su entrada que hace recordar la historieta "El Fantasma".</p>
            </div>
         </div> 
      </div>

      <h2 class="text">
         <span>a</span><span>m</span><span>a</span><span>z</span><span>o</span><span>n</span><span>a</span><span>s</span>
      </h2>
      <div class="box-container">
         <div class="box">
            <img src="images/amazonas-1.jpg" alt="Cascada Idaya">
            <div class="cont">
               <h3>Cascada Idaya</h3>
               <p>Hermosa cascada oculta en el estado Amazonas con una vista maravillosa</p>
            </div>
         </div>
         <div class="box">
            <img src="images/amazonas-2.jpg" alt="Río de Amazonas">
            <div class="cont">
               <h3>Río de Amazonas</h3>
               <p>Disfruta de observar el río y selva de Amazonas</p>
            </div>
         </div>
         <div class="box">
            <img src="images/amazonas-3.jpg" alt="Cerro Autana Amazonas">
            <div class="cont">
               <h3>Cerro Autana Amazonas</h3>
               <p>Cerro Autana representa el árbol de la vida, que dio origen a todas las frutas.</p>
            </div>
         </div> 
      </div>

      <h2 class="text">
         <span>i</span><span>s</span><span>l</span><span>a</span><br>
         <br><span>m</span><span>a</span><span>r</span><span>g</span><span>a</span><span>r</span><span>i</span><span>t</span><span>a</span>
      </h2>
      <div class="box-container">
         <div class="box">
            <img src="images/marga-1.jpg" alt="Playa Agua">
            <div class="cont">
               <h3>Playa el Agua</h3>
               <p>Puedes disfrutar de esta hermosa playa, con personas maravillosas</p>
            </div>
         </div>
         <div class="box">
            <img src="images/marga-2.jpg" alt="Playa Parguito">
            <div class="cont">
               <h3>Playa Parguito</h3>
               <p> Una de las playas más populares de la isla de Margarita, y tiende a ser una de las favoritas de los jóvenes.</p>
            </div>
         </div>
         <div class="box">
            <img src="images/marga-3.jpg" alt="Parque Nacional Laguna de la Restinga">
            <div class="cont">
               <h3>Parque Nacional Laguna de la Restinga</h3>
               <p>Es uno de los principales atractivos turísticos de la Isla de Margarita que no puede dejar de conocer.</p>
            </div>
         </div> 
      </div>
   </section>
   <!-- LUGARES TURÍSTICO SECCIÓN-->


   <!-- ClIENTES SECCIÓN-->
   <section class="review" id="review">
      <h1 class="heading_1"> nuestros clientes nos avalan </h1>
      <div class="linea"></div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-quote-right"></i>
            <div class="user">
               <img src="images/Gabi.jpg" alt="">
               <h3>Gabriela Fernández</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <div class="comment">
               Sus precios son accesible y prestan un buen servicio, 100% recomendado. Apropiado si quieres disfrutar de unas merecidas vacaciones.               </div>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-quote-right"></i>
            <div class="user">
               <img src="images/Carmen.jpg" alt="">
               <h3>Carmen Castellanos</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <div class="comment">
                  Con Ventour he podido disfrutar de cada paisaje turístico que nos regala Venezuela, es un excelente servicio para viajar, se los recomiendo 100%.
               </div>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-quote-right"></i>
            <div class="user">
               <img src="images/wil.jpg" alt="">
               <h3>Wilmer Villarreal</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
               </div>
               <div class="comment">
               Excelente servicio, me gusta mucho viajar y a tráves de Ventour he conocido a mi hermoso país Venezuela y todo lo que su naturaleza nos ofrece.
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- ClIENTES SECCIÓN-->

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
   
   <!-- REISTRO SECCIÓN-->
   <section class="form-container" id="registro__1">
      <form action="" method="post" >
         <h3>registrate ahora</h3>
         <div class="linea" id="linea"></div>
         <input type="text" name="name" class="box" placeholder="ingresa tu nombre" required>
         <input type="email" name="email" class="box" placeholder="ingresa tu email" required>
         <input type="password" name="pass" class="box" placeholder="ingresa tu contraseña" required>
         <input type="password" name="cpass" class="box" placeholder="confirma tu contraseña" required>
         <input type="submit" class="btn" name="submit" value="registrate ahora">
         <p>ya tienes una cuenta? <a href="auth/login.php">inicia sesión</a></p>
      </form>
   </section>
   <!-- REGISTRO SECCIÓN-->

   <!-- FOOTER SECCIÓN-->
   <footer class="footer">
      <div class="box-container">
         <div class="box">
            <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
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
            <a href="home.php" class="link"><i class="fas fa-arrow-right"></i>Home</a>
            <a href="#nosotros" class="link"><i class="fas fa-arrow-right"></i>Nosotros</a>
            <a href="#lugares__" class="link"><i class="fas fa-arrow-right"></i>Lugares</a>
            <a href="contactos.php" class="link"><i class="fas fa-arrow-right"></i>Contactos</a>
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
   
   <script src="js/script2.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.7/swiper-bundle.min.js" integrity="sha512-WlN87oHzYKO5YOmINf1+pSkbt4gm+lOro4fiSTCjII4ykJe/ycHKIaa9b2l9OMkbqEA4NxwTXAGFjSXgqEh19w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="js/slider.js"></script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script>
      AOS.init({
         duration: 2000
      });
      document.getElementById('year-home').innerHTML = new Date().getFullYear();
   </script>
</body>
</html>