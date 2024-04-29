<?php

    require_once('Connexio.php');
    require_once('Header.php');
    
    /**
     * Clase que se encarga de gestionar la eliminación de productos.
     */
    class Eliminar {
        
        /**
         * Función que elimina el producto cuya $id se inserta por parámetro.
         * 
         * @param type $id
         * @return type
         */
        public function eliminaProducte($id) {
            
            /**
             * Si no se recibe una $id, o si ésta no es numérica, se lanzará un
             * mensaje avisando de que el ID del producto no es válido y se 
             * saldrá de la aplicación.
             */
            if (!isset($id) || !is_numeric($id)) {
                echo '<p>ID de producto no válido.</p>';
                return;
            }
            
            $conexionObj = new Connexio();
            $conexion = $conexionObj->obtenirConnexio();
            
            $consulta = "DELETE FROM productes WHERE id ='" . $id . "';";
            $resultado = $conexion->query($consulta);
            
            echo '<div class="container mt-5" style="margin-bottom: 200px"> 
                    <h2>Eliminar producte</h2>
                    <hr>
                    <p>';
            
            /**
             * Si el $resultado es correcto, se avisará al usuario de que el 
             * producto se ha eliminado correctamente. Por el contrario, se
             * notificará que ha havbido un error.
             */
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