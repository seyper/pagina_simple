<?php
require_once 'conexion.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$correo = trim($_POST['correo']);
$contra = trim($_POST['contra']);

$fecha_entrada = $_POST['fecha_entrada'];

$query = "SELECT * FROM usuario WHERE correo='$correo'";
$result = mysqli_query($dbconn, $query) or die('error ' . mysqli_error($dbconn));

if ($result) {
    $data = mysqli_fetch_assoc($result);

    if (password_verify($contra, $data['contraseña'])) {
        session_start();
        $_SESSION['id']   = $data['id_usuario'];
        $_SESSION['usuario']  = $data['correo'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['permiso'] = $data['permiso'];
        $_SESSION['fecha_entrada'] = $fecha_entrada;

        header("Location: ../administrador/admin.php");
    } else {
        header("location: ../index.php?alert=error_sesion"); //Error en el inicio de sesion
    }
}
