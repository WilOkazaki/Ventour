<?php

@include 'config/config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:auth/login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_hotel = $_POST['product_hotel'];
   $product_estado = $_POST['product_estado'];
   $product_tiempo = $_POST['product_tiempo'];
   $product_personas = $_POST['product_personas'];


   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');


   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }
   else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image, hotel, estado, tiempo, personas) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image', '$product_hotel', '$product_estado', '$product_tiempo',
       '$product_personas')") or die('query failed');
       $message[] = 'product added to wishlist';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin.css">


</head>
<body>

   <header>
      <div id="menu-bar" class="fas fa-bars"></div>
      <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
      
      <nav class="navbar">
         <a href="home_cliente.php">Inicio</a>
         <a href="home_cliente.php #nosotros">Nosotros</a>
         <a href="home_cliente.php #lugares__">Lugares</a>
      </nav>
      <div class= "icons">
         <a href="wishlist.php"><i class="fa-solid fa-cart-plus"></i></a>
         
         <a class="ico">Paquete</a>
      </div>
   </header>


   <div class="shops"> 
         <h1 class="title">Paquetes disponibles</h1>
         <div class="linea" id="linea"></div>
   </div>

   <section class="products">
      <div class="box-container">

         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="POST" class="box">
            <div class="price">$<?php echo $fetch_products['price']; ?></div>
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
            <div class="name" id="names"><?php echo $fetch_products['name']; ?></div>
            <div class="linea" id="linea"></div>
            <div class="estado">Estado: <?php echo $fetch_products['estado']; ?></div>
            <div class="hotel">Hotel: <?php echo $fetch_products['hotel']; ?></div>
            <div class="tiempo">Tiempo: <?php echo $fetch_products['tiempo']; ?></div>
            <div class="personas">Personas: <?php echo $fetch_products['personas']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_hotel" value="<?php echo $fetch_products['hotel']; ?>">
            <input type="hidden" name="product_estado" value="<?php echo $fetch_products['estado']; ?>">
            <input type="hidden" name="product_tiempo" value="<?php echo $fetch_products['tiempo']; ?>">
            <input type="hidden" name="product_personas" value="<?php echo $fetch_products['personas']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="agregar paquete" name="add_to_wishlist" class="option-btn">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

   </section>

   <!--Footer-->
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
            <a href="index.php" class="link"><i class="fas fa-arrow-right"></i>Home</a>
            <a href="index.php #lugares" class="link"><i class="fas fa-arrow-right"></i>Lugares</a>
            <a href="#nosotros" class="link"><i class="fas fa-arrow-right"></i>Nosotros</a>
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



<script src="js/script2.js"></script>

</body>
</html>