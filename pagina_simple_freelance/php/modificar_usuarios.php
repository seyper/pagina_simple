<?php
session_start();
require_once '../php/conexion.php';

$contra = $_POST['contra'];
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$correo = trim($_POST['correo']);
$telefono_cel = trim($_POST['telefono_cel']);
$telefono_fijo = trim($_POST['telefono_fijo']);
$direccion = trim($_POST['direccion']);

$id = $_SESSION['id'];

$opciones = [
    'cost' => 12,
];
$contra_cifrada = password_hash($contra, PASSWORD_BCRYPT, $opciones);

$query = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo='$correo', contraseña='$contra_cifrada', telefono_cel='$telefono_cel', telefono_fijo='$telefono_fijo', direccion='$direccion' WHERE id_usuario='$id'";
$result = mysqli_query($dbconn, $query) or die (mysqli_error($dbconn));
header("location: ../administrador/admin.php?alert=modf_exito");
