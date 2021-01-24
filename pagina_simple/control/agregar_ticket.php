<?php
session_start();
require_once '../conexion/conexion.php';

$id = $_SESSION['id'];
$departamento = $_POST['departamento'];
$telefono_contac = trim($_POST['telefono_contac']);
$email = trim($_POST['email']);
$problema = trim($_POST['problema']);

$query = "INSERT INTO ticket (solicitante, departamento, telefono_contac, email, problema, estatus) VALUES ('$id','$departamento', '$telefono_contac', '$email', '$problema', 'enviado')";
$result = mysqli_query($dbconn, $query) or die('Error al enviar: '. mysqli_error($dbconn));
if($result){
    header("location: ../views/admin.php?alert=exito_ticket");
} else{
    header("location: ../views/admin.php?alert=error_ticket");
}