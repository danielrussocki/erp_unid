<?php 
require_once 'config/config.php';
require_once ROOT_PATH . '/libs/database.php';
global $db;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Vacantes</title>
</head>
<body id="vacantes">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2>Consulta las vacantes que tenemos disponibles</h2>
            </div>
        </div>
    </div>
    <?php
        $vacantes = $db->select("vacantes(vac)", [
            "[><]departamentos_rh(d)" => ["vac.departamento_vac" => "id"],
            "[><]estados(e)" => ["vac.estado_vac" => "id_est"],
            "[><]jornadas(j)" => ["vac.jornada_vac" => "id_jor"]
        ],
            ["vac.id_vac", "vac.titulo_vac", "d.name", "e.nombre_est", "j.nombre_jor", "vac.sueldo_vac", "vac.experiencia_vac",
            "ofrecemos_vac", "vac.edad_vac"]
        );
        foreach ($vacantes as $vacante) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6">
                <h3><?=$vacante["titulo_vac"];?></h3>
                <p>
                    <strong>Ubicación:</strong> <?=$vacante["nombre_est"];?><br/>
                    <strong>Departamento: </strong><?=$vacante["name"];?><br/>
                    <strong>Horario:</strong> <?=$vacante["nombre_jor"];?><br/>
                    <strong>Edad:</strong> <?=$vacante["edad_vac"];?><br/>
                    <strong>Sueldo:</strong> <?=money_format("%.0n", $vacante["sueldo_vac"]);?> MXN <br/>
                    <strong>Ofrecemos:</strong> <?=$vacante["ofrecemos_vac"];?><br/>
                    <strong>Experiencia requerida:</strong> <?=$vacante["experiencia_vac"];?><br/>
                </p>
                </div>
            </div>
            <? } ?>
        </div>
    </div>
  
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>