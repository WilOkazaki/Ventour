<?php

   @include 'config/config.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:auth/login.php');
   };

   if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $hotel = mysqli_real_escape_string($conn, $_POST['hotel']);
   $estado = mysqli_real_escape_string($conn, $_POST['estado']);
   $personas = mysqli_real_escape_string($conn, $_POST['personas']);
   $tiempo = mysqli_real_escape_string($conn, $_POST['tiempo']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, hotel, price, estado, personas, tiempo, image) VALUES('$name', '$hotel', '$price', '$estado', '$personas', '$tiempo', '$image')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'imagen muy grande';
         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'paquete agregado con éxito!';
         }
      }
   }

   }

   if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('admin_products.php');

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN PAQUETES</title>

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

   <section class="add-products">

      <form action="" method="POST" enctype="multipart/form-data">
         <h3>agregar nuevo paquete</h3>
         <div class="linea" id="linea"></div>
         <input type="text" class="box" required placeholder="Ingresa el nombre del paquete" name="name">
         <input type="number" min="0" class="box" required placeholder="Ingresa el precio del paquete" name="price">
         <input type="text" class="box" required placeholder="Ingresa el hotel" name="hotel">
         <input type="text" class="box" required placeholder="Ingresa el estado" name="estado">
         <input type="text" class="box" required placeholder="Ingresa el tiempo" name="tiempo">
         <input type="text" class="box" required placeholder="Ingresa el numero de personas" name="personas">
         <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
         <input type="submit" value="agregar paquete" name="add_product" class="btn">
      </form>

   </section>


   <section class="paque"> 
      <h2>Paquetes agregados</h2>
      <div class="linea"></div>
   </section>

   <section class="show-products">

      <div class="box-container">

         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="box">
            <div class="price">$<?php echo $fetch_products['price']; ?></div>
            <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="linea" id="linea"></div>
            <div class="estado">Estado: <?php echo $fetch_products['estado']; ?></div>
            <div class="hotel">Hotel: <?php echo $fetch_products['hotel']; ?></div>
            <div class="tiempo">Tiempo: <?php echo $fetch_products['tiempo']; ?></div>
            <div class="personas">Personas: <?php echo $fetch_products['personas']; ?></div>
            <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">editar</a>
            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">eliminar</a>
         </div>
         <?php
            }
         }else{
            echo '<p class="empty">no se ha agregado el producto</p>';
         }
         ?>
      </div>

   </section>

   <script src="js/admin_script.js"></script>
</body>
</html>