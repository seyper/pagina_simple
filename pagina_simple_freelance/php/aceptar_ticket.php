<?php
require_once 'conexion.php';

$id = $_POST['id'];
$departamento = $_POST['departamento'];
$telefono_contac = trim($_POST['telefono_contac']);
$email = trim($_POST['email']);
$problema= trim($_POST['problema']);

$query = "UPDATE ticket SET departamento = '$departamento', telefono_contac='$telefono_contac', email = '$email', problema = '$problema', estatus='aceptado' WHERE solicitante = '$id'";
$result = mysqli_query($dbconn, $query) or die('Error al aceptar el ticket' . mysqli_error($dbconn));
if($result){
    header("location: ../administrador/consultar_ticket.php?alert=exito_aceptar");
}else{
    header("location: ../administrador/consultar_ticket.php?alert=error_aceptar");
}