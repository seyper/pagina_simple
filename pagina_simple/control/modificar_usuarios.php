<?php
session_start();
require_once '../conexion/conexion.php';

$contra = (!empty($_POST['contra'])) ? trim($_POST['contra']) : '';
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$correo = trim($_POST['correo']);
$telefono_cel = trim($_POST['telefono_cel']);
$telefono_fijo = trim($_POST['telefono_fijo']);
$direccion = trim($_POST['direccion']);

$id = $_SESSION['id'];

if ($contra == '') {
    $query = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo='$correo', telefono_cel='$telefono_cel', telefono_fijo='$telefono_fijo', direccion='$direccion' WHERE id_usuario='$id'";
} else {
    $opciones = [
        'cost' => 12,
    ];
    $contra_cifrada = password_hash($contra, PASSWORD_BCRYPT, $opciones);
    $query = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo='$correo', contraseña='$contra_cifrada', telefono_cel='$telefono_cel', telefono_fijo='$telefono_fijo', direccion='$direccion' WHERE id_usuario='$id'";
}



$result = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
if ($result) {
    header("location: ../views/admin.php?alert=modf_exito");
} else {
    header("location: ../views/admin.php?alert=modf_error");
}
