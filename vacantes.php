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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Vacantes</title>
</head>
<body id="vacantes">
    <div class="position-relative overflow-hidden">
        <div class="container-md" style="height: 500px;" id="main-container">
            <div class="row h-75">
                <div class="col-md-5 mr-auto my-auto">
                    <h2 class="animate__animated animate__fadeInLeft">Te ayudamos a encontrar un trabajo mejor.</h2>
                    <p class="underlined-blue mt-3 animate__animated animate__fadeInLeft animate__delay-1s">Encuentra la oportunidad de tus sueños.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 h-25">
                    <button class="vacantes-btn animate__animated animate__backInUp animate__delay-2s" type="button">Vacantes disponibles</button>
                </div>
            </div>
        </div>
        <div class="position-absolute w-100 h-100 overlay-blue" style="top: 0; left: 0; z-index: -1;">
            <img class="d-block w-100 h-100" style="object-fit: cover;" src="./assets/images/desk.jpg" alt="desk">
        </div>
    </div>
    <div class="nav__container animate__animated animate__bounceIn animate__delay-3s">
        <nav class="nav">
            <input type="checkbox" class="nav__cb" id="menu-cb"/>
            <div class="nav__content">
                <ul class="nav__items">
                    <li class="nav__item">
                        <a href="javascript:void(0)" class="nav__item-text">
                        Inicio
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="javascript:void(0)" class="nav__item-text">
                        Vacantes
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="javascript:void(0)" class="nav__item-text">
                        Nosotros
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="javascript:void(0)" class="nav__item-text">
                        Contacto
                        </a>
                    </li>
                </ul>
            </div>
            <label class="nav__btn" for="menu-cb"></label>
        </nav>
    </div>
    <div class="overflow-hidden">
        <div class="container animate__animated animate__fadeInDown animate__delay-4s">
            <div class="row">
                <div class="col">
                    <h6 class="text-center">Ubicaciones disponibles</h6>
                    <hr>
                </div>
            </div>
            <div class="row">
                <?php
                $ubicaciones = $db->select("vacantes(vac)", [
                    "[><]estados(e)" => ["vac.estado_vac" => "id_est"]
                ], ["e.nombre_est"], [
                    "GROUP" => 'e.nombre_est'
                ]);
                    foreach ($ubicaciones as $key => $ubicacion) {
                        $temp = $db->count("vacantes(vac)", [
                            "[><]estados(e)" => ["vac.estado_vac" => "id_est"]
                        ], ["e.nombre_est"], [
                            "e.nombre_est" => $ubicacion["nombre_est"]
                        ]);
                ?>
                <div class="col-md-2 text-center py-1">
                    <a style="color:inherit;" href="javascript:void(0)"><?=$ubicacion["nombre_est"];?></a> <span class="badge badge-primary"><?=$temp;?></span>
                </div>
                <?php
                    }
                ?>
            </div>
            <hr>
            <div class="row">
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
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <?=$vacante["name"];?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?=$vacante["titulo_vac"];?> - <small style="font-weight: 300;"><?=$vacante["nombre_est"];?></small></h5>
                            <h6><?= $vacante["sueldo_vac"];?> MXN</h6>
                            <p class="card-text"><span style="font-weight: bold;">Edad: </span><?=$vacante["edad_vac"];?></p>
                            <p class="card-text"><span style="font-weight: bold;">Experiencia: </span><?=$vacante["experiencia_vac"];?></p>
                            <p class="card-text"><span style="font-weight: bold;">Ofrecemos: </span><?=$vacante["ofrecemos_vac"];?></p>
                        </div>
                        <div class="card-footer text-muted d-flex align-items-center">
                            <span class="d-block"><?=$vacante["nombre_jor"];?></span>
                            <a href="#" class="d-block btn btn-outline-info text-right ml-auto">Postularse</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <footer class="mt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <hr style="border-color: rgba(255,255,255,.6);">
                    <small class="d-block text-right">Footer pedorro de muestra.</small>
                </div>
            </div>
        </div>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>