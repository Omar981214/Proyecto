<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<?php
if($_POST){
    $total=0;
    $SID=Session_id();
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
}
$sentencia=$pdo->prepare("INSERT INTO `tblventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES (NULL, '12345678910', '', '2021-12-14 03:40:15', '123456@gmail.com', '700', 'Pendiente');");
$sentencia->execute();
echo "<h3>".$total."</h3>";
}
?>

<?php include 'templates/pie.php'; ?>