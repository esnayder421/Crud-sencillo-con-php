<?php
require_once 'conexion.php';
$id = base64_decode($_GET['id']);
$sql ="DELETE FROM `producto` WHERE id=$id";
$datos = $con->query($sql);
// despues de borrar el dato redireccionamos a el index (pagina principal)
header("location:index.php");
