<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloUsuarios = $db->select("modulos", "id_modulo", ["nombre_modulo" => "usuarios"]);
?>
<!DOCTYPE html>
<html lang="mx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Categorías</title>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php include(ROOT_PATH . "/includes/navbar.php"); ?>
        <div class="app-main">
        <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
                <!-- Inicio del contenedor -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php
                        // Separo index de las vistas para mantener intacto el contenedor (Esta sección)
                        // y así sea más fácil trabajar a la hora de modificar el html modificando solo
                        // las vistas. También para solo copiar y pegar xd
                        include './vcategorias.php';
                        ?>
                    </div>
                    <!-- Footer -->
                    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
                </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="../../assets/scripts/main.js"></script>
<!-- Modal Editar -->
<div class="modal fade" id="detallesCategorias" tabindex="-1" role="dialog" aria-labelledby="detallesCategoriasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesCategoriasLabel">Detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" class="form-control" placeholder="Ej. Alejandro Fernández">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCats" data-dismiss="modal" disabled>Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal -->
<!-- Modal Insertar -->
<div class="modal fade" id="insertarCategoria" tabindex="-1" role="dialog" aria-labelledby="insertarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertarCategoriaLabel">Crear nueva categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nombreInsert">Nombre:</label>
                        <input type="text" id="nombreInsert" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="insertCat" data-dismiss="modal">Guardar Categoría</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal -->
<!-- Modal eliminar -->
<div class="modal fade" id="eliminarCategoria" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar este campo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnEliminarCat" data-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal eliminar -->
<script src="../../../vendor/components/jquery/jquery.min.js"></script>
<script src="./cats.js"></script>
</body>
</html>
<?php
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>