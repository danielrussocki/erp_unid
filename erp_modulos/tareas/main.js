$(document).ready(function() {
    var obj = {};

    $(".btnModulo").click(function(e) {
        e.preventDefault();
        console.log("hola");
    });

    $("#newTarea").click(function() {
        obj = {
            action: "insertar",
        };
        $("#modalTareas .modal-title").text("Nueva Tarea");
        $("#btnInsertTarea").text("Insertar");
        $("#formTareas")[0].reset();
    });

    $(".btnEdit").click(function() {
        let id = $(this).attr("data-id");
        obj = {
            action: "consultar",
            id_tar: id,
        };
        $.post(
            "functions.php",
            obj,
            function(res) {
                res = res[0];
                tinyMCE.get('desc_tar').setContent(res.desc_tar);
                $("#usr_tar").val(res.usr_tar);
                $("#usr2_tar").val(res.usr2_tar);
                $("#fechaasig_tar").val(res.fechaasig_tar);
                $("#status_tar").val(res.status_tar);

                obj = {
                    action: "editar",
                    id_tar: id,
                };
            },
            "JSON"
        );
        $("#modalTareas .modal-title").text("Editar Tarea");
        $("#btnInsertTarea").text("Editar");
    });

    $(".btnDelete").click(function() {
        let id = $(this).attr("data-id");
        obj = {
            action: "eliminar",
            id_tar: id,
        };
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir los cambios.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33 ",
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Eliminar",
        }).then((result) => {
            if (result.value) {
                $.post(
                    "functions.php",
                    obj,
                    function(res) {
                        if (res.activo_tar == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Tarea eliminada correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
            }
        });
    });

    $("#btnInsertTarea").click(function() {
        let validInputs = true;
        tinyMCE.triggerSave();
        $("#modalTareas").find("input, select, textarea").map(function() {
            if ($(this).val().trim() == '') {
                $(this).addClass('is-invalid');
                validInputs = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (!validInputs) return;
        $("#modalTareas")
            .find("input")
            .map(function(i, e) {
                obj[e.name] = $(this).val();
            });
        $("#modalTareas")
            .find("select")
            .map(function(i, e) {
                obj[e.name] = $(this).val();
            });
        $('#modalTareas')
            .find("textarea")
            .map(function(i, e) {
                obj[e.name] = $(this).val();
            });

        switch (obj.action) {
            case "insertar":
                $.post(
                    "functions.php",
                    obj,
                    function(res) {
                        if (res.activo_tar == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Se agregó la tarea correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
                break;

            case "editar":
                $.post(
                    "functions.php",
                    obj,
                    function(res) {
                        if (res.activo_tar == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Se ha editado correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
                break;

            default:
                break;
        }
    });
});

$('.detalles-tarea').click(function (event) {
    var modal = $('#tiempoDetallesModal');
    modal.find('.modal-body').text('Loading...');
    var button = $(event.target); // Button that triggered the modal
    var recipient = button.data('tarea'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    detailsObj = {
        action: 'detalles-tarea',
        id_tar: recipient
    };
    $.ajax({
        url: './functions.php',
        type: 'POST',
        dataType: 'json',
        data: detailsObj,
        success: (r) => {
            template = '';
            $.each(r, function(key, val){
                console.log(key, val);
                template += `
                <div>
                    <span style="font-weight:bold;">${val.tiempo}</span> ${val.cambios}
                </div>
                `;
            });
            modal.find('.modal-body').html(template);
        }
    });
});

$('.iniciar-tarea').click(function(event){
    var button = $(event.target); // Button that triggered the modal
    var recipient = button.data('tarea'); // Extract info from data-* attributes
    let tareaObj = {
        action: 'iniciar-tarea',
        id_tar: recipient
    }
    $.post(
        "functions.php",
        tareaObj,
        function(res) {
            if (res.status == 1) {
                Swal.fire({
                    icon: "success",
                    title: "¡Perfecto!",
                    text: "Se ha comenzado la tarea",
                }).then(() => {
                    location.reload();
                });
            }
        },
        "JSON"
    );
});
$('.pausar-tarea').click(function(event){
    var button = $(event.target); // Button that triggered the modal
    var recipient = button.data('tarea'); // Extract info from data-* attributes
    let tareaObj = {
        action: 'pausar-tarea',
        id_tar: recipient
    }
    $.post(
        "functions.php",
        tareaObj,
        function(res) {
            if (res.status == 1) {
                Swal.fire({
                    icon: "success",
                    title: "¡Perfecto!",
                    text: "Se ha pausado la tarea",
                }).then(() => {
                    location.reload();
                });
            }
        },
        "JSON"
    );
});
$('.reanudar-tarea').click(function(event){
    var button = $(event.target); // Button that triggered the modal
    var recipient = button.data('tarea'); // Extract info from data-* attributes
    let tareaObj = {
        action: 'reanudar-tarea',
        id_tar: recipient
    }
    $.post(
        "functions.php",
        tareaObj,
        function(res) {
            if (res.status == 1) {
                Swal.fire({
                    icon: "success",
                    title: "¡Perfecto!",
                    text: "Se ha reanudado la tarea",
                }).then(() => {
                    location.reload();
                });
            }
        },
        "JSON"
    );
});
$('.terminar-tarea').click(function(event){
    var button = $(event.target); // Button that triggered the modal
    var recipient = button.data('tarea'); // Extract info from data-* attributes
    let tareaObj = {
        action: 'terminar-tarea',
        id_tar: recipient
    }
    $.post(
        "functions.php",
        tareaObj,
        function(res) {
            if (res.status == 1) {
                Swal.fire({
                    icon: "success",
                    title: "¡Perfecto!",
                    text: "Se ha terminado la tarea",
                }).then(() => {
                    location.reload();
                });
            }
        },
        "JSON"
    );
});