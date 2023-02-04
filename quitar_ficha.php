<?php
require_once 'conexion.php';
$id = $_GET['id'];
$ficha = $_GET['ficha'];
$sql ="UPDATE `producto` SET ficha='' WHERE id=$id";
$datos = $con->query($sql);
$ruta ="ficha/".$ficha;
unlink($ruta);
// despues de borrar el dato redireccionamos a el index (pagina principal)
header("location:index.php");
