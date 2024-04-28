<?php

    require_once('Connexio.php');
    require_once('Header.php');

    class Nou {

        public function nouProducte() {

            $conexionObj = new Connexio();
            $conexion = $conexionObj->obtenirConnexio();

            $consulta = "SELECT id, nom FROM categories;";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {

                echo '<div class="container mt-5" style="margin-bottom: 200px"> 
                        <h2>Afegir producte</h2>
                        <hr>';
                echo '<form action="Nou.php" method="POST">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nombre:</label>
                            <input type="text" id="nom" name="nom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripción:</label>
                            <input type="text" id="descripcio" name="descripcio" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="preu" class="form-label">Precio:</label>
                            <input type="number" id="preu" name="preu" class="form-control" step="any" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select id="categoria" name="categoria" class="form-select">
                      ';

                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['nom'] . '</option>';
                }

                echo '</select>
                        </div>
                        <input type="submit" value="Añadir" class="btn btn-primary">
                        <a href="Principal.php" class="btn btn-secondary">Volver atrás</a>
                        </form>';
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $consulta_maxId = "SELECT MAX(id) + 1 FROM productes;";
                $resultado_maxId = $conexion->query($consulta_maxId);
                $fila = $resultado_maxId->fetch_row();
                $id = $fila[0];

                $nom = $_POST['nom'];
                $descripcio = $_POST['descripcio'];
                $preu = $_POST['preu'];
                $categoria_id = $_POST['categoria'];

                $stmt = $conexion->prepare("INSERT INTO productes (id, nom, descripció, preu, categoria_id) 
                                        VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issdi", $id, $nom, $descripcio, $preu, $categoria_id);

                if ($stmt->execute()) {
                    echo '<hr>
                            <p style="margin-top: 15px; color: green; text-align: center;">
                                Se ha añadido el producto correctamente.
                            </p>';
                } else {
                    echo '<hr>
                            <p style="margin-top: 15px; color: red; text-align: center;">
                                Error al añadir el producto: ' . $conexion->error . '
                            </p>';
                }

                $stmt->close();
            }

            echo '</div>';
            require_once('Footer.php');
            $conexion->close();
        }

    }

    $afegirProducte = new Nou();
    $afegirProducte->nouProducte();

?>