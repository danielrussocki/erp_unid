<?php
// Probablemente les marque error
// pero en realidad está bien, es el
// intelephense que no detecta bien
// las rutas

// APP - CLIENTES

// Se crea el objeto y clase de la app
// ***************************
// Procuren utilizar ese objeto para almacenar
// toda la información a utilizar en el template
// para no tener tantas variables y tener más
// órden y organización

// Creado el objeto, almacenar la información
// con un identificador

class ERPApp {
    public $moduleName = "Clientes";
    public $moduleDescription = "Aquí va la descripción.";
}

$app = new ERPApp();
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div><?php echo $app->moduleName; ?>
                <div class="page-title-subheading"><?php echo $app->moduleDescription; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header"><?php echo $app->moduleName; ?>
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <?php
                        //Si el id del modulo está en el array de permisos insertar muestra el boton
                        if (in_array($idModuloClientes[0], $_SESSION["insertar"])) :
                        ?>
                            <button class="btn-wide btn btn-success" data-toggle="modal" data-target="#insertarCliente">
                                Nuevo cliente
                            </button>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <!-- <th class="text-center">#</th> -->
                        <th class="text-center">Nombre</th>
                        <th class="text-center">País</th>
                        <th class="text-center">Categoría</th>
                        <?php
                            //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el th
                        if (in_array($idModuloClientes[0], $_SESSION["editar"]) || in_array($idModuloClientes[0], $_SESSION["eliminar"])) :
                        ?>
                        <th class="text-center">Acciones</th>
                        <?php
                        endif;
                        ?>
                    </tr>
                    </thead>
                    <!-- <tbody id="clitbody"></tbody> -->
                    <tbody id="clitbody">
                    <?php
                    $clientes = $db->select("clientes(cli)", [
                        "[><]categorias(cat)" => ["cli.categoria_cli" => "id_cat"]
                    ],

                    ["cli.id_cli", "cli.foto_cli", "cli.pais_cli", "cli.nombre_cli", "cli.correo_cli", "cat.nombre_cat"]
                    );
                        foreach ($clientes as $cliente) {
                    ?>
                    <tr>
                        <td>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="widget-content-left">
                                            <img width="40" class="rounded-circle" src="<?php echo $cliente['foto_cli']; ?>" alt="user-pic">
                                        </div>
                                    </div>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading"><?php echo utf8_encode($cliente['nombre_cli']); ?></div>
                                        <div class="widget-subheading opacity-7"><?php echo $cliente['correo_cli']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><?php echo utf8_encode($cliente['pais_cli']); ?></td>
                        <td class="text-center">
                            <div class="badge badge-info"><?php echo $cliente['nombre_cat']; ?></div>
                        </td>
                        <?php
                        //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el td
                        if (in_array($idModuloClientes[0], $_SESSION["editar"]) || in_array($idModuloClientes[0], $_SESSION["eliminar"])) :
                        ?>
                            <td class="text-center">
                                <?php
                                //Si el id del modulo está en el array de permisos editar muestra el boton
                                if (in_array($idModuloClientes[0], $_SESSION["editar"])) :
                                ?>
                                    <button type="button" class="btn btn-primary btn-sm get-user-data" data-client="<?php echo $cliente['id_cli']; ?>" data-toggle="modal" data-target="#detallesModal">
                                        Editar
                                    </button>
                                <?php
                                endif;

                                //Si el id del modulo está en el array de permisos eliminar muestra el boton
                                if (in_array($idModuloClientes[0], $_SESSION["eliminar"])) :
                                ?>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger delete-user-data" data-client="<?php echo $cliente['id_cli']; ?>" data-toggle="modal" data-target="#eliminarCliente">
                                        <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                    </button>
                                <?php
                                endif;
                                ?>
                            </td>
                        <?php
                        endif;
                        ?>
                        <!-- <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm get-user-data" data-client="<?php echo $cliente['id_cli']; ?>" data-toggle="modal" data-target="#detallesModal">Editar</button>
                            <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger delete-user-data" data-client="<?php echo $cliente['id_cli']; ?>" data-toggle="modal" data-target="#eliminarCliente"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                        </td> -->
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- Esto igual y podría removerse -->
            <div class="d-block text-center card-footer">
                <!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                <button class="btn-wide btn btn-success">Save</button> -->
            </div>
        </div>
    </div>
</div>