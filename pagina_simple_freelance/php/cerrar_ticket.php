<?php
require_once 'conexion.php';

$id = $_GET['id'];
$query = "UPDATE ticket SET estatus = 'cerrado' WHERE solicitante = '$id'";
$result = mysqli_query($dbconn, $query) or die('Error al cerrar ticket: '. mysqli_error($dbconn));
if($result){
    header("location: ../administrador/consultar_ticket.php?alert=cerrar_exito");
}else{
    header("location: ../administrador/consultar_ticket.php?alert=cerrar_error");
}