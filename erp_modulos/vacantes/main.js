$(document).ready(function() {
    var obj = {};

    $(".btnModulo").click(function(e) {
        e.preventDefault();
        console.log("hola");
    });

    $("#newVacante").click(function() {
        obj = {
            action: "insertar",
        };
        $(".modal-title").text("Nueva Vacante");
        $("#btnInsertVacante").text("Insertar");
        $("#formVacantes")[0].reset();
    });

    $(".btnEdit").click(function() {
        let id = $(this).attr("data-id");
        obj = {
            action: "consultar",
            id_vac: id,
        };
        $.post(
            "functions.php",
            obj,
            function(res) {
                res = res[0];
                $("#titulo_vac").val(res.titulo_vac);
                $("#estado_vac").val(res.estado_vac);
                $("#departamento_vac").val(res.departamento_vac);
                $("#jornada_vac").val(res.jornada_vac);
                $("#edad_vac").val(res.edad_vac);
                $("#sueldo_vac").val(res.sueldo_vac);
                // $("#experiencia_vac").val(res.experiencia_vac);
                // $("#ofrecemos_vac").val(res.ofrecemos_vac);
                tinyMCE.get('experiencia_vac').setContent(res.experiencia_vac);
                tinyMCE.get('ofrecemos_vac').setContent(res.ofrecemos_vac);

                obj = {
                    action: "editar",
                    id_vac: id,
                };
            },
            "JSON"
        );
        $(".modal-title").text("Editar Usuario");
        $("#btnInsertVacante").text("Editar");
    });

    $(".btnDelete").click(function() {
        let id = $(this).attr("data-id");
        obj = {
            action: "eliminar",
            id_vac: id,
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
                        if (res.status_vac == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Vacante eliminada correctamente",
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

    $("#btnInsertVacante").click(function() {
        let validInputs = true;
        tinyMCE.triggerSave();
        $("#modalVacantes").find("input, select, textarea").map(function(){
            if($(this).val().trim() == ''){
                $(this).addClass('is-invalid');
                validInputs = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if(!validInputs) return;
        $("#modalVacantes")
            .find("input")
            .map(function(i, e) {
                obj[e.name] = $(this).val();
            });
        $("#modalVacantes")
            .find("select")
            .map(function(i, e) {
                obj[e.name] = $(this).val();
            });
        $('#modalVacantes')
            .find("textarea")
            .map(function(i, e){
                obj[e.name] = $(this).val();
            });

        switch (obj.action) {
            case "insertar":
                $.post(
                    "functions.php",
                    obj,
                    function(res) {
                        if (res.status_vac == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Se agregó la vacante correctamente",
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
                        if (res.status_vac == 1) {
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