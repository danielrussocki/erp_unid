<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloUsuarios = $db->select("modulos", "id_modulo", ["nombre_modulo" => "vacantes"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloUsuarios[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
?>
    <!DOCTYPE html>
    <html lang="mx">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <title>Vacantes</title>
    </head>

    <body>
        <!-- Full Container -->
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!-- Navbar -->
            <?php include(ROOT_PATH . "/includes/navbar.php"); ?>
            <!-- Container app main -->
            <div class="app-main">
                <!-- Sidenav -->
                <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
                <!-- App Content -->
                <div class="app-main__outer">
                    <!-- Content -->
                    <div class="app-main__inner">
                        <!-- Page title -->
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <!-- Img title -->
                                    <div class="page-title-icon">
                                        <?php
                                        $iconoVacantes = $db->get('modulos', 'icono_modulo', ['nombre_modulo' => 'vacantes']);
                                        ?>
                                        <i class="<?php echo $iconoVacantes; ?> icon-gradient bg-mean-fruit"></i>
                                    </div>
                                    <!-- Title & subtitle -->
                                    <div>
                                        Consultar vacantes
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalVacantes" id="newVacante">
                                            Nueva vacante
                                        </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table class="mb-0 table table-bordered text-center" id="tableVacantes">
                                            <thead>
                                                <tr>
                                                    <th>#</th>    
                                                    <th>Titulo</th>
                                                    <th>Departamento</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $vacantes = $db->select("vacantes", "*");
                                                    foreach ($vacantes as $vacante) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $vacante["id_vac"]; ?></td>
                                                        <td><?php echo $vacante["titulo_vac"]; ?></td>
                                                        <td><?php echo $vacante["departamento_vac"]; ?></td>
                                                        <td><?php echo $vacante["estado_vac"]; ?></td>
                                                        <td> <button class="btnEdit mr-2 btn btn-outline-primary" data="<?php echo $vacante['id_vac'] ?>" data-toggle="modal" data-target="#modalVacantes">
                                                                        Editar </button>
                                                            <button class="btnDelete mr-2 btn btn-outline-danger" data="<?php echo $vacante["id_vac"]; ?>">
                                                                        Eliminar </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
                </div>
                <!-- /App Content -->
            </div>
            <!-- /Container app main -->
        </div>
        <!-- /Full Container -->
        <script type="text/javascript" src="<?php echo constant('URL') ?>/assets/scripts/main.js"></script>
        <script type="text/javascript" src="<?php echo constant('URL') ?>/vendor/components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo constant('URL') ?>/erp_modulos/vacantes/main.js"></script>
        <script src="https://cdn.tiny.cloud/1/pwzdplmh9jw9bm4mxpjzjmnr5958n79k1v636aeb82h9zivw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- TINYMCE -->
        <script type="text/javascript">
            tinyMCE.init({
                selector: "#experiencia_vac, #ofrecemos_vac",
                mode: "textareas",
                plugins: "paste,link,preview",
                theme_advanced_buttons3_add: "pastetext,pasteword,selectall,link",
                paste_auto_cleanup_on_paste: true
            });
        </script>
    </body>

    </html>

    <!-- Modal -->
    <div class="modal fade" id="modalVacantes" tabindex="-1" role="dialog" aria-labelledby="modalVacantes" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insertar nueva vacante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formVacantes">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Titulo de la vacante</label>
                                <input type="text" class="form-control" id="titulo_vac" name="titulo_vac">
                            </div>
                            <div class="col-md-4">
                                <label>Estado</label>
                                <select name="estado_vac" id="estado_vac" class="form-control">
                                    <?php
                                    global $db;
                                    $query = $db->select("estados","*",["ORDER" =>["id_est" => "ASC"]]);
                                        foreach($query as $clave => $valor){
                                    ?>
                                    <option value="<?php echo $valor['id_est']; ?>"><?php echo $valor['nombre_est']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Departamento</label>
                                <select name="departamento_vac" id="departamento_vac" class="form-control">
                                    <?php
                                    global $db;
                                    $query = $db->select("departamentos_rh","*",["ORDER" =>["id" => "ASC"]]);
                                        foreach($query as $clave => $valor){
                                    ?>
                                    <option value="<?php echo $valor['id']; ?>"><?php echo $valor['name']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Jornada</label>
                                <select name="jornada_vac" id="jornada_vac" class="form-control">
                                    <?php
                                        global $db;
                                        $query = $db->select("jornadas","*",["ORDER" =>["id_jor" => "ASC"]]);
                                            foreach($query as $clave => $valor){
                                        ?>
                                        <option value="<?php echo $valor['id_jor']; ?>"><?php echo $valor['nombre_jor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Edad</label>
                                <input type="text" class="form-control" id="edad_vac" name="edad_vac">
                            </div>
                            <div class="col-md-4">
                                <label>Sueldo</label>
                                <input type="text" class="form-control" id="sueldo_vac" name="sueldo_vac">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Experiencia</label>
                                <form method="post">
                                    <textarea id="experiencia_vac" name="experiencia_vac"></textarea>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <label>Ofrecemos</label>
                                <form method="post">
                                    <textarea id="ofrecemos_vac" name="ofrecemos_vac"></textarea>
                                </form>
                            </div>
                        </div>
                        <button class="btn btn-outline-success" id="btnInsertVacante" type="button">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
} else {
    header("Location:" . URL . "/erp_modulos/login/index.php");
}
?>