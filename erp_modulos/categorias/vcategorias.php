<?php
class ERPCats {
    // Aquí pon textos de manera dinámica si gustas
    public $moduleName = "Categorías";
    public $moduleDescription = "Aquí va la descripción.";
}
$cats = new ERPCats();
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <!-- Para llamarlos así -->
            <div><?php echo $cats->moduleName; ?>
                <div class="page-title-subheading"><?php echo $cats->moduleDescription; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header"><?php echo $cats->moduleName; ?>
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="btn-wide btn btn-success" data-toggle="modal" data-target="#insertarCategoria">Nueva categoría</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <!-- <th class="text-center">#</th> -->
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="catstbody"></tbody>
                </table>
            </div>
            <!-- Esto igual y podría removerse -->
            <div class="d-block text-center card-footer">
                <!-- <button class="btn-wide btn btn-success">Save</button> -->
            </div>
        </div>
    </div>
</div>