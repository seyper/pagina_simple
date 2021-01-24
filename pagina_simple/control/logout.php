<?php
session_start();
// para destruir la sesion
require_once '../conexion/conexion.php';
$fecha_salida= date("Y-m-d H:i:s");
$id_usuario = $_SESSION['id'];
$fecha_entrada = $_SESSION['fecha_entrada'];

//Guardando datos dentro de auditoria
$query = "INSERT INTO auditoria (id_usuario, fecha_entrada, fecha_salida) VALUES ('$id_usuario', '$fecha_entrada', '$fecha_salida')";
$result = mysqli_query($dbconn, $query) or die('Error al hacer auditoria: ' . mysqli_error($dbconn));

unset($_SESSION['id']);
unset($_SESSION['correo']);
session_destroy($_SESSION['correo']);

//redirecciona al login incluyendo una alerta
header('Location: ../index.php?alert=salida');
?>