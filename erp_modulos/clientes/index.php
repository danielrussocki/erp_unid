<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloClientes = $db->select("modulos", "id_modulo", ["nombre_modulo" => "clientes"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloClientes[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
?>
    <!DOCTYPE html>
    <html lang="mx">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
        <title>Clientes</title>
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
                        include './vclientes.php';
                        ?>
                    </div>
                    <!-- Footer -->
                    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
                </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="../../assets/scripts/main.js"></script>
<script type="text/javascript" src="<?php echo constant('URL') ?>/vendor/components/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
<script>
    $('#tableClientes').bootstrapTable({
        pagination: true,
        search: true
    });
</script>
<!-- Modal -->
<div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div role="group" class="btn-group-sm nav btn-group">
                    <a id="first-tab-edit" data-toggle="tab" href="#tab-editfac-0" class="btn-shadow active btn btn-primary">Editar cliente</a>
                    <a id="second-tab-edit" data-toggle="tab" href="#tab-editfac-1" class="btn-shadow btn btn-primary">Dirección de facturación</a>
                    <a id="third-tab-edit" data-toggle="tab" href="#tab-editfac-2" class="btn-shadow btn btn-primary">Dirección de envío</a>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-editfac-0" role="tabpanel">
                        <form enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" class="form-control">
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" id="apellido" class="form-control">
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" id="telefono" class="form-control" placeholder="Ej. 9981234567">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="correo">Correo:</label>
                                    <input type="email" id="correo" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="idioma">Idioma:</label>
                                    <input type="text" id="idioma" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pais">País:</label>
                                    <input type="text" id="pais" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="categoria">Categoría:</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        <?php
                                        global $db;
                                        $query = $db->select("categorias","*",["ORDER" =>["id_cat" => "ASC"]]);
                                            foreach($query as $clave => $valor){
                                        ?>
                                        <option value="<?php echo $valor['id_cat']; ?>"><?php echo $valor['nombre_cat']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="envio">Dir. Envío:</label>
                                    <input type="text" id="envio" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="facturacion">Dir. Facturación:</label>
                                    <input type="text" id="facturacion" class="form-control">
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label for="foto">Foto:</label>
                                    <input type="file" id="foto" name="foto" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab-editfac-1" role="tabpanel">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Estado</label>
                                <select name="estado" id="editEstado" class="form-control">
                                <?php
                                global $db;
                                $query = $db->select("estados","*",["ORDER" =>["id_est" => "ASC"]]);
                                    foreach($query as $clave => $valor){
                                ?>
                                <option value="<?php echo $valor['id_est']; ?>"><?php echo $valor['nombre_est']; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Ciudad</label>
                                <input type="text" id="editCiudad" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Calle</label>
                                <input type="text" id="editCalle" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Entre</label>
                                <input type="text" id="editEntre" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Super manzana</label>
                                <input type="text" id="editSuperManzana" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Manzana</label>
                                <input type="text" id="editManzana" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Lote</label>
                                <input type="text" id="editLote" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Municipio</label>
                                <input type="text" id="editMunicipio" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Código Postal</label>
                                <input type="text" id="editCodigoPostal" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- EDITAR DIRECCIÓN ENVÍO -->
                    <div class="tab-pane" id="tab-editfac-2" role="tabpanel">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Direcciones disponibles</th>
                                    <!-- <th class="text-center">Dirección</th> -->
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="envbody"></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="form-row">
                             <div class="form-group col-md-4">
                                <label for="">Titulo <div class="widget-subheading opacity-7">Ej. casa, oficina, etc. </div></label>
                                <input type="text" id="insertTitulo" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Estado</label>
                                <select name="estado" id="insertEstado2" class="form-control">
                                <?php
                                global $db;
                                $query = $db->select("estados","*",["ORDER" =>["id_est" => "ASC"]]);
                                    foreach($query as $clave => $valor){
                                ?>
                                <option value="<?php echo $valor['id_est']; ?>"><?php echo $valor['nombre_est']; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="">Ciudad</label>
                                <input type="text" id="insertCiudad2" class="form-control">
                            </div> -->
                            <div class="form-group col-md-4">
                                <label for="">Municipio</label>
                                <input type="text" id="insertMunicipio2" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Calle</label>
                                <input type="text" id="insertCalle2" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Entre</label>
                                <input type="text" id="insertEntre2" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Super manzana</label>
                                <input type="text" id="insertSuperManzana2" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Manzana</label>
                                <input type="text" id="insertManzana2" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Lote</label>
                                <input type="text" id="insertLote2" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Código Postal</label>
                                <input type="text" id="insertCodigoPostal2" class="form-control">
                            </div>
                        </div>
                        <div id="envioInsertBtns">
                            <button id="insertEnv" type="button" class="btn btn-success d-block ml-auto">Crear</button>
                        </div>
                        <div id="envioEditBtns" class="text-right" style="display: none;">
                            <button id="cancelEditEnv" type="button" class="btn btn-secondary d-inline-block">Cancelar</button>
                            <button id="editEnv" type="button" class="btn btn-success d-inline-block">Editar</button>
                        </div>
                    </div>
                    <!-- FIN EDITAR DIRECCIÓN ENVÍO -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveDetails" data-dismiss="modal" disabled>Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal -->
<!-- Modal Insertar -->
<div class="modal fade" id="insertarCliente" tabindex="-1" role="dialog" aria-labelledby="insertarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div role="group" class="btn-group-sm nav btn-group">
                    <a id="first-tab" data-toggle="tab" href="#tab-eg5-0" class="btn-shadow active btn btn-primary">Crear cliente</a>
                    <a id="second-tab" data-toggle="tab" href="#tab-eg5-1" class="btn-shadow btn btn-primary disabled">Dirección de facturación</a>
                    <!-- <a id="third-tab" data-toggle="tab" href="#tab-eg5-2" class="btn-shadow btn btn-primary disabled">Dirección de envío</a> -->
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg5-0" role="tabpanel">
                        <form enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombreInsert">Nombre:</label>
                                    <input type="text" id="nombreInsert" class="form-control">
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label for="apellidoInsert">Apellido:</label>
                                    <input type="text" id="apellidoInsert" class="form-control">
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label for="telInsert">Teléfono:</label>
                                    <input type="tel" id="telInsert" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="correoInsert">Correo:</label>
                                    <input type="text" id="correoInsert" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="idiomaInsert">Idioma:</label>
                                    <input type="text" id="idiomaInsert" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="paisInsert">País:</label>
                                    <input type="text" id="paisInsert" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="catInsert">Categoría:</label>
                                    <select name="categoria" id="catInsert" class="form-control">
                                        <?php
                                        global $db;
                                        $query = $db->select("categorias","*",["ORDER" =>["id_cat" => "ASC"]]);
                                            foreach($query as $clave => $valor){
                                        ?>
                                        <option value="<?php echo $valor['id_cat']; ?>"><?php echo $valor['nombre_cat']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="envioInsert">Dirección de Envío:</label>
                                    <input type="text" id="envioInsert" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="factInsert">Dirección de Facturación:</label>
                                    <input type="text" id="factInsert" class="form-control">
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label for="fotoInsert">Foto:</label>
                                    <input type="file" id="fotoInsert" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab-eg5-1" role="tabpanel">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Estado</label>
                                <select name="categoria" id="insertEstado" class="form-control">
                                    <?php
                                    global $db;
                                    $query = $db->select("estados","*",["ORDER" =>["id_est" => "ASC"]]);
                                        foreach($query as $clave => $valor){
                                    ?>
                                    <option value="<?php echo $valor['id_est']; ?>"><?php echo $valor['nombre_est']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Ciudad</label>
                                <input type="text" id="insertCiudad" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Calle</label>
                                <input type="text" id="insertCalle" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Entre</label>
                                <input type="text" id="insertEntre" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Super manzana</label>
                                <input type="text" id="insertSuperManzana" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Manzana</label>
                                <input type="text" id="insertManzana" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Lote</label>
                                <input type="text" id="insertLote" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Municipio</label>
                                <input type="text" id="insertMunicipio" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Código Postal</label>
                                <input type="text" id="insertCodigoPostal" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane" id="tab-eg5-2" role="tabpanel">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                               <label for="">Título <div class="widget-subheading opacity-7">Ej. casa, oficina, etc. </div></label>
                                <input type="text" id="insertTitulo" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Estado</label>
                                <select name="categoria" id="insertEstado2" class="form-control">
                                    <?php
                                    global $db;
                                    $query = $db->select("estados","*",["ORDER" =>["id_est" => "ASC"]]);
                                        foreach($query as $clave => $valor){
                                    ?>
                                    <option value="<?php echo $valor['id_est']; ?>"><?php echo $valor['nombre_est']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Ciudad</label>
                                <input type="text" id="insertCiudad2" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Calle</label>
                                <input type="text" id="insertCalle2" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Entre</label>
                                <input type="text" id="insertEntre2" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Super manzana</label>
                                <input type="text" id="insertSuperManzana2" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Manzana</label>
                                <input type="text" id="insertManzana2" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Lote</label>
                                <input type="text" id="insertLote2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Municipio</label>
                                <input type="text" id="insertMunicipio2" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Código Postal</label>
                                <input type="text" id="insertCodigoPostal2" class="form-control">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="nextTab">Siguiente</button>
                <button type="button" class="btn btn-primary" id="insertCli" style="display: none;" data-dismiss="modal">Crear</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal -->
<!-- Modal eliminar -->
<div class="modal fade" id="eliminarCliente" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar este cliente?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnEliminarCliente" data-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal eliminar -->
<script src="../../vendor/components/jquery/jquery.min.js"></script>
<script src="./clientes.js"></script>
</body>
</html>
<?php
    }
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>