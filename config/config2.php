<?php

    $conn = mysqli_connect('localhost','root','','ventourbd2');

    if (!$conn) {
        die("<script>alert('Conexión Fallida.')</script>");
    }

    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    $mensaje=($_POST['mensaje']);

    $sql="INSERT into contact (nombre,email,telefono,mensaje)
            values ('$nombre','$email','$telefono','$mensaje')";
    echo mysqli_query($conn,$sql);
?>