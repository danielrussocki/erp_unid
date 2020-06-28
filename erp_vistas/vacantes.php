<?php
require_once '../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
global $db;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/erp_vistas/vacantes.css" />
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
                            <button type="button" class="d-block btn btn-outline-info text-right ml-auto" data-toggle="modal" data-target="#vacantesVistaModal" data-vacanteid="<?=$vacante['id_vac']; ?>" data-vacante="<?=$vacante["titulo_vac"]; ?>">Postularse</button>
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
    <div class="modal fade" id="vacantesVistaModal" tabindex="-1" role="dialog" aria-labelledby="vacantesVistaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vacantesVistaModalLabel">Rellena el formulario para postularte a esta vacante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="postulacionForm">
                        <input type="hidden" name="vacante_post" id="postulante-vacante">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="postulante-name">Nombre completo:</label>
                                <input name="nombre_post" type="text" class="form-control" id="postulante-name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postulante-correo">Correo electrónico:</label>
                                <input name="correo_post" type="email" class="form-control" id="postulante-correo" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="postulante-telefono">Teléfono (opcional):</label>
                                <input name="telefono_post" type="text" class="form-control" id="postulante-telefono">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postulante-cv">CV:</label>
                                <input name="cv_post" type="file" class="form-control" id="postulante-cv" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="posulante-descripcion">Carta de presentación (opcional):</label>
                                <textarea name="descripcion_post" class="form-control" id="posulante-descripcion" cols="30" rows="4" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="mensajeRespuesta"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="submitPostulacion">Enviar</button>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>
    $('#vacantesVistaModal').on('show.bs.modal', function (e) {
        $('#postulacionForm')[0].reset();
        let button = $(e.relatedTarget);
        let vacante = button.data('vacante');
        let modal = $(this);
        modal.find('.modal-title').text('Rellena el formulario para postularte a la vacante de ' + vacante);
        modal.find('#postulante-vacante').val(button.data('vacanteid'));
        // modal.find('.modal-body #postulante-name').val(vacante);
    });
    $('#submitPostulacion').click(function(){
        let obj = {};
        let formulario = $('#postulacionForm');
        let validData = true;
        formulario.find('input, textarea').map(function(i,el){
            // obj[e.name] = $(this).val();
            if($(el).val().trim() == "" && $(el).attr('required')){
                validData = false;
                $(el).addClass('is-invalid');
            } else {
                $(el).removeClass('is-invalid');
            }
            obj[el.name] = $(el).val();
        });
        if(!validData){
            return;
        }
        if(!validateEmail(obj.correo_post)){
            $("#postulante-correo").addClass('is-invalid');
            return;
        } else {
            $("#postulante-correo").removeClass('is-invalid');
        }
        obj.acciones = 'insert-postulante';
        let formData = new FormData();
        if(obj.cv_post != ''){
            let imagen = $('#postulante-cv').prop("files")[0];
            formData.append("file", imagen);
            obj.cv_post = $('#postulante-cv').val().replace(/C:\\fakepath\\/i, '');
        }
        $.ajax({
            url: './funciones/cv.php',
            contentType: false,
            processData: false,
            data: formData,
            type: 'POST',
            beforeSend: () => {
                $('#submitPostulacion').text('Enviando...');
            }
        }).done(function(){
            $.ajax({
                url: './funciones/functions.php',
                type: 'POST',
                dataType: 'json',
                data: obj
            }).done(function(resp){
                // console.log(resp);
                if(resp.status == 1){
                    $('#vacantesVistaModal').modal('hide');
                    $('#submitPostulacion').text('Enviar');
                } else {
                    $('#mensajeRespuesta').html(`
                    <div class="alert alert-danger" role="alert">
                        Algo salió mal, intente nuevamente.
                    </div>
                    `);
                    $('#submitPostulacion').text('Enviar');
                }
            });
        });
    });
    function validateEmail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            return true;
        }
        return false;
    }
</script>
</body>
</html>