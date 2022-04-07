<?php

@include 'config/config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:auth/login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart';
   }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if(mysqli_num_rows($check_wishlist_numbers) > 0){
         mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      }

      mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart';
   }

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
   header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
   header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CARRITO PAQUETE</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style5.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

	<header>
   <div id="menu-bar" class="fas fa-bars"></div>
      <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
      
      <nav class="navbar">
         <a href="home_cliente.php">Inicio</a>
         <a href="home_cliente.php #nosotros">Nosotros</a>
         <a href="home_cliente.php #lugares__">Lugares</a>
			<a href="cliente_product.php">Paquetes</a>
			<a href="cliente_page.php">Perfil</a>
      </nav>
		<div class= "icons">
			<a href="cliente_product.php"><i class="fa-solid fa-cart-plus"></i></a>
			<a class="ico">Agregar</a>
		</div>
	</header>
   
	<section class="lista">
		<h1 class="title">Paquetes agregados</h1>
		<div class="linea" id="linea"></div>
	</section>

	<section class="wishlist">

		<div class="box-container">

		<?php
			$grand_total = 0;
			$select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
			if(mysqli_num_rows($select_wishlist) > 0){
				while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
		?>
		<form action="" method="POST" class="box">
			<a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
			<img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="" class="image">
			<div class="name"><?php echo $fetch_wishlist['name']; ?></div>
			<div class="linea" id="linea"></div>
			<div class="price">$<?php echo $fetch_wishlist['price']; ?></div>
			<input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
			<input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
			<input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
			<input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
		</form>
		<?php
		$grand_total += $fetch_wishlist['price'];
			}
		}else{
			echo '<p class="empty">tu lista esta vacia</p>';
		}
		?>
		</div>

		<div class="wishlist-total">
			<p>Total a cancelar : <span>$<?php echo $grand_total; ?></span></p>
			<a href="cliente_product.php" class="option-btn" id="pago">pago</a>
			<a href="cliente_product.php" class="option-btn">atrás</a>
			<a href="wishlist.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('delete all from wishlist?');">eliminar</a>
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
            <a href="home_cliente.php" class="link"><i class="fas fa-arrow-right"></i>Home</a>
            <a href="home_cliente.php #nosotros" class="link"><i class="fas fa-arrow-right"></i>Nosotros</a>
            <a href="home_cliente.php #lugares__" class="link"><i class="fas fa-arrow-right"></i>Lugares</a>
            <a href="cliente_product.php" class="link"><i class="fas fa-arrow-right"></i>Paquetes</a>
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