<?php
session_start();
$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){
        case 'Agregar':
            if(is_numeric( openssl_decrypt( $_POST['id'],COD,KEY))){
                $ID=openssl_decrypt( $_POST['id'],COD,KEY);
                $mensaje="Ok ID correcto".$ID. "</br>";
            }else{
                $mensaje.="Ups...ID Incorrecto".$ID."</br>";
            }
            if(is_string(openssl_decrypt($_POST['Nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['Nombre'],COD,KEY);
                $mensaje="Ok nombre correcto".$NOMBRE."</br>";
            }else{ $mensaje.="Upps...algo pasa con el nombre"."</br>";break;}

            if(is_numeric(openssl_decrypt($_POST['Cantidad'],COD,KEY))){
                $CANTIDAD=openssl_decrypt($_POST['Cantidad'],COD,KEY);
                $mensaje.="Ok cantidad correcta".$CANTIDAD."</br>";
            }else{ $mensaje.="Upps...algo pasa con la cantidad"."</br>";break;}

            if(is_numeric(openssl_decrypt($_POST['Precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['Precio'],COD,KEY);
                $mensaje.="Ok precio correcto".$PRECIO."</br>";
            }else{ $mensaje.="Upps...algo pasa con el precio"."</br>";break;}
           if(!isset($_SESSION['CARRITO'])){
               $producto=array(
                   'ID'=>$ID,
                   'NOMBRE'=>$NOMBRE,
                   'CANTIDAD'=>$CANTIDAD,
                   'PRECIO'=>$PRECIO
               );
               $_SESSION['CARRITO'][0]=$producto;
               $mensaje= "Producto Agregado al carrito";
          
            }else{
                $idProductos=array_column($_SESSION['CARRITO'],"ID");
                if(in_array($ID,$idProductos)){
                    echo "<script>alert('El producto ya ha sido seleccionado'...);</script>";

                }else{
               $NumeroProductos=count($_SESSION['CARRITO']);
               $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][$NumeroProductos]=$producto;
            $mensaje= "Producto Agregado al carrito";
        }

    }
            //$mensaje= print_r( $_SESSION,true);
            break;
            case "Eliminar":
                if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                   
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){

                    if($producto['ID']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...');</script>";
                    }

                   }

                }else{
                    $mensaje.="Ups...ID Incorrecto".$ID."</br>";
                }


            break;
    }

}


?>