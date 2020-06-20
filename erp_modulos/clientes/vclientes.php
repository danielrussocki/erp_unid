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
                        <button class="btn-wide btn btn-success" data-toggle="modal" data-target="#insertarCliente">Nuevo cliente</button>
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
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="clitbody"></tbody>
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