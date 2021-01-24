<?php
session_start();
require_once '../php/conexion.php';

$contra = $_POST['contra'];
$id = $_SESSION['id'];

$opciones = [
    'cost' => 12,
];
$contra_cifrada = password_hash($contra, PASSWORD_BCRYPT, $opciones);

$query = "UPDATE usuario SET contraseña='$contra_cifrada' WHERE id_usuario='$id'";
$result = mysqli_query($dbconn, $query) or die (mysqli_error($dbconn));
header("location: ../administrador/admin.php?alert=modf_exito");
