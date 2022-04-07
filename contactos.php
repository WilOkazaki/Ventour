<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.2.1.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/style3.css">
    <title>VENTUOR | Contáctanos</title>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
<header>
            <div id="menu-bar" class="fas fa-bars"></div>
            <a href= "#" class="logo"><img src="images/loggo.png" alt="logo"></a>
        
            <nav class="navbar">
                <a href= "home.php">inicio</a>
                <a href="home.php #nosotros">Nosotros</a>
                <a href= "home.php #lugares__">Lugares</a>
            </nav>
            <div class= "icons">
                <a href="auth/login.php"><i class="fas fa-user" id="login-btn"></i></a>
                <a class="ico">inicia sesión</a>
            </div>

		</header>

        <!--HEADER SECCION-->

        <!-- CONTACTOS-->

        <!-- contact section starts  -->

        <section class="contact" id="contact">

            <div class="image">
                <img src="images/turismo-en-venezuela-17.jpg" alt="">
                <p>La oficina principal de <strong>VEN TOUR</strong> se encuentra ubicada en la ciudad de Trujillo, Venezuela, cubriendo todo el país. Atendido por personal altamente capacitado, con una gran experiencia y preparación; dispuestos a ofrecer un servicio de primera clase.</p>
            </div>

            <form action="" id="formulario" method="POST" >

                <div class="con" ><h1 class="heading">¡Contactanos!</h1></div>
                
                <div class="inputBox">
                    <input type="text" name="nombre" id="nombre" required>
                    <label>Nombre</label>
                </div>

                <div class="inputBox">
                    <input type="email" name="email" id="email" required>
                    <label>Email</label>
                </div>

                <div class="inputBox">
                    <input type="text" name="telefono" id="telefono" required>
                    <label>Teléfono</label>
                </div>

                <div class="inputBox">
                    <textarea required name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
                    <label>Envianos un mensaje</label>
                </div>

                <input type="submit" class="btn" value="Enviar Mensaje" id="act">

            </form>

        </section>

<!-- contact section edns -->

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
                <a href="index.php#lugares__" class="link"><i class="fas fa-arrow-right"></i>Lugares</a>
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
            <h1 class="credit"> &copy; copyright @ <span id="contacto"></span> by Team. C.G.W.S </h1>
        </footer>
           
        

    <script src="js/script2.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2000
        });
        document.getElementById('contacto').innerHTML = new Date().getFullYear();
    </script>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#act').click(function(){
			var datos=$('#formulario').serialize();
            // Verificamos si los campos estan vacios
            if($('#nombre').val()=="" || $('#email').val()=="" || $('#telefono').val()=="" || $('#mensaje').val()==""){
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })

                    Toast.fire({
                      icon: 'error',
                      title: 'Todos los campos son obligatorios'
                    })
                return
            }

			$.ajax({
				type:"POST",
				url:"config/config2.php",
				data:datos,
				success:function(r){
					if(r==1){
                        const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })

                    Toast.fire({
                      icon: 'success',
                      title: 'Agregado con exito'
                    })
					}else{
                        const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })

                    Toast.fire({
                      icon: 'error',
                      title: 'Error al agregar'
                    })
					}
				}
			});

			return false;
		});
	});
</script>