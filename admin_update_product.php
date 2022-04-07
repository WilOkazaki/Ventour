<?php

   @include 'config/config.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:auth/login.php');
   };

   if(isset($_POST['update_product'])){

      $update_p_id = $_POST['update_p_id'];
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $price = mysqli_real_escape_string($conn, $_POST['price']);
      $hotel = mysqli_real_escape_string($conn, $_POST['hotel']);
      $estado = mysqli_real_escape_string($conn, $_POST['estado']);
      $tiempo = mysqli_real_escape_string($conn, $_POST['tiempo']);
      $personas = mysqli_real_escape_string($conn, $_POST['personas']);

      mysqli_query($conn, "UPDATE `products` SET name = '$name', hotel = '$hotel', estado = '$estado', tiempo = '$tiempo', personas = '$personas', price = '$price' WHERE id = '$update_p_id'") or die('query failed');

      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folter = 'uploaded_img/'.$image;
      $old_image = $_POST['update_p_image'];
      
      if(!empty($image)){
         if($image_size > 2000000){
            $message[] = 'image file size is too large!';
         }else{
            mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($image_tmp_name, $image_folter);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image updated successfully!';
         }
      }

      $message[] = 'product updated successfully!';

   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar producto</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin.css">
</head>
<body>
   

   <section class="update-product">

      <?php

         $update_id = $_GET['update'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
         <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
         <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
         <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="editar nombre del paquete" name="name">  
         <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="editar precio del paquete" name="price">
         <input type="text" class="box" value="<?php echo $fetch_products['estado']; ?>" required placeholder="editar estado" name="estado">
         <input type="text" class="box" value="<?php echo $fetch_products['hotel']; ?>" required placeholder="editar hotel" name="hotel">
         <input type="text" class="box" value="<?php echo $fetch_products['tiempo']; ?>" required placeholder="editar tiempo" name="tiempo">
         <input type="text" class="box" value="<?php echo $fetch_products['personas']; ?>" required placeholder="editar cantidad de personas" name="personas">
         <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
         <input type="submit" value="editar paquete" name="update_product" class="btn">
         <a href="admin_products.php" class="option-btn">atrás</a>
      </form>

      <?php
            }
         }else{
            echo '<p class="empty">no se ha seleccionado el paquete a editar</p>';
         }
      ?>
   </section>

   <script src="js/admin_script.js"></script>
</body>
</html>