<?php

    require_once('Connexio.php');
    require_once('Header.php');
    
    class Eliminar {
        
        public function eliminaProducte($id) {
            
            if (!isset($id) || !is_numeric($id)) {
                echo '<p>ID de producto no válido.</p>';
                return;
            }
            
            $conexionObj = new Connexio();
            $conexion = $conexionObj->obtenirConnexio();
            
            $consulta = "DELETE FROM productes WHERE id ='" . $id . "';";
            $resultado = $conexion->query($consulta);
            
            echo '<div class="container mt-5" style="margin-bottom: 200px"> 
                    <h2>Usuń produkt</h2>
                    <hr>
                    <p>';
            
            if ($resultado === TRUE) {
                echo 'Producto eliminado correctamente.';
            } else {
                echo 'Ha habido algún error que ha impedido eliminar el producto.';
            }
            
            echo '<hr>
                <a href="Principal.php" class="btn btn-secondary">Volver atrás</a>';
            
            echo '</p></div>';
            require_once('Footer.php');
            $conexion->close();
            
        }
        
    }
    
    $idProducto = isset($_GET['id']) ? $_GET['id'] : null;
    
    $eliminarProducte = new Eliminar();
    $eliminarProducte->eliminaProducte($idProducto);

?>