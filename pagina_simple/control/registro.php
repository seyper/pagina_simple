<?php
require_once "../conexion/conexion.php";

$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$correo = trim($_POST['correo']);

$contra = trim($_POST['contra']);
$opciones = [
    'cost' => 12,
];
$contra_cifrada = password_hash($contra, PASSWORD_BCRYPT, $opciones);

$query = "INSERT INTO usuario (nombre, apellido, correo, contraseña, permiso) VALUES ('$nombre', '$apellido', '$correo','$contra_cifrada', 'usuario')";
$result = mysqli_query($dbconn, $query) or die('Error al insertar usuario: ' . mysqli_error($dbconn));
if($result){
    header("location: ../views/index.php?alert=reg_exitoso");
}else{
    header("location: ../views/index.php?alert=reg_errado");
}