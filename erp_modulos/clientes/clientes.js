// Request Methods de la API
// GET - Llama datos sin necesidad de un post

$(document).ready(function(){
    // Click categorias detalles
    // Se usa on para activarlo en el DOM
    // Si se usa solo click en este caso, no funciona
    // getStartData();
    $('#clitbody').on('click', '.get-user-data', function(){
        let id = $(this).attr('data-client');
        $('#saveDetails').attr('data-client', id);
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${id}`,
            type: 'GET',
            dataType: 'json',
            success: (r) => {
                $('#second-tab-edit').attr('data-fac', r.dir_fact_cli);
                $('#saveDetails').prop('disabled', false);
                $('#nombre').val(r.nombre_cli);
                $('#correo').val(r.correo_cli);
                $('#telefono').val(r.tel_cli);
                $('#categoria').val(r.categoria_cli);
                $('#pais').val(r.pais_cli);
                $('#idioma').val(r.idioma_cli);
                $('#envio').val(r.envio_cli);
                $('#facturacion').val(r.dir_fact_cli);
                $('#foto').val('');
                let facid = $('#second-tab-edit').attr('data-fac');
                $.ajax({
                    url: `https://erp-unid.herokuapp.com/api/billaddress/${facid}`,
                    type: 'GET',
                    dataType: 'json',
                    success: (r) => {
                        $('#editEstado').val(r.estado_fac);
                        $('#editCiudad').val(r.ciudad_fac);
                        $('#editCalle').val(r.calle_fac);
                        $('#editEntre').val(r.entre_fac);
                        $('#editSuperManzana').val(r.sm_fac);
                        $('#editManzana').val(r.mza_fac);
                        $('#editLote').val(r.lte_fac);
                        $('#editMunicipio').val(r.municipio_fac);
                        $('#editCodigoPostal').val(r.cp_fac);
                    }
                });
            }
        });
        getStartDataEnv(id);
    });

    // ENVIO
    // getStartDataEnv();
    // $('#envbody').on('click', '.get-user-data', function(){
    //     let id = $(this).attr('data-client');
    //     $('#saveDetails').attr('data-client', id);
    //     $.ajax({
    //         url: `https://erp-unid.herokuapp.com/api/clients/${id}`,
    //         type: 'GET',
    //         dataType: 'json',
    //         success: (r) => {
    //             $('#third-tab-edit').attr('data-fac', r.dir_fact_cli);
    //             $('#saveDetails').prop('disabled', false);
    //             $('#nombre').val(r.nombre_cli);
    //             $('#correo').val(r.correo_cli);
    //             $('#telefono').val(r.tel_cli);
    //             $('#categoria').val(r.categoria_cli);
    //             $('#pais').val(r.pais_cli);
    //             $('#idioma').val(r.idioma_cli);
    //             $('#envio').val(r.envio_cli);
    //             $('#facturacion').val(r.dir_fact_cli);
    //             $('#foto').val('');
    //             let envid = $('#third-tab-edit').attr('data-fac');
    //             $.ajax({
    //                 url: ` https://erp-unid.herokuapp.com/api/clientes/${id}/envios/${envid}`,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 success: (r) => {
    //                     $('#editTitulo').val(r.estado_env);
    //                     $('#editEstado2').val(r.estado_env);
    //                     $('#editCiudad2').val(r.ciudad_env);
    //                     $('#editCalle2').val(r.calle_env);
    //                     $('#editEntre2').val(r.entre_env);
    //                     $('#editSuperManzana2').val(r.sm_env);
    //                     $('#editManzana2').val(r.mza_env);
    //                     $('#editLote2').val(r.lte_env);
    //                     $('#editMunicipio2').val(r.municipio_env);
    //                     $('#editCodigoPostal2').val(r.cp_env);
    //                 }
    //             });
    //         }
    //     });
    // });
    // FIN ENVIO
    $('#clitbody').on('click', '.delete-user-data', function(){
        let id = $(this).attr('data-client');
        $('#btnEliminarCliente').attr('data-client', id);
    });
    $('#btnEliminarCliente').click(function(){
        let id = $('#btnEliminarCliente').attr('data-client');
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: (r) => {
                location.reload();
            }
        });
    });
    $('#saveDetails').on('click','',function(e){
        let id = $(this).attr('data-client');
        let cli_nombre = $('#nombre').val();
        // let cli_apellido = $('#apellido').val();
        let cli_tel = $('#telefono').val();
        let cli_correo = $('#correo').val();
        let cli_idioma = $('#idioma').val();
        let cli_pais = $('#pais').val();
        let cli_categoria = $('#categoria').val();
        // let cli_envio = $('#envio').val();
        // let cli_facturacion = $('#facturacion').val();
        let cli_foto = $('#foto').val();
        let formData = new FormData();
        if(cli_foto != ''){
            let imagen = $('#foto').prop("files")[0];
            formData.append("file", imagen);
            cli_foto = $('#foto').val().replace(/C:\\fakepath\\/i, '');
        }
        let obj = {
            nombre_cli: cli_nombre,
            // apellido_cli: cli_apellido,
            tel_cli: cli_tel,
            correo_cli: cli_correo,
            idioma_cli: cli_idioma,
            pais_cli: cli_pais,
            categoria_cli: cli_categoria,
            // envio_cli: cli_envio,
            // dir_fact_cli: cli_facturacion,
            foto_cli: cli_foto
        };
        let editEstado = $('#editEstado').val();
        let editCiudad = $('#editCiudad').val();
        let editCalle = $('#editCalle').val();
        let editEntre = $('#editEntre').val();
        let editSuperManzana = $('#editSuperManzana').val();
        let editManzana = $('#editManzana').val();
        let editLote = $('#editLote').val();
        let editMunicipio = $('#editMunicipio').val();
        let editCodigoPostal = $('#editCodigoPostal').val();
        let faceditobj = {
            estado_fac: editEstado,
            ciudad_fac: editCiudad,
            calle_fac: editCalle,
            entre_fac: editEntre,
            sm_fac: editSuperManzana,
            mza_fac: editManzana,
            lte_fac: editLote,
            municipio_fac: editMunicipio,
            cp_fac: editCodigoPostal
        };
        let editTitulo = $('#editTitulo').val();
        let editEstado2 = $('#editEstado2').val();
        let editCiudad2 = $('#editCiudad2').val();
        let editCalle2 = $('#editCalle2').val();
        let editEntre2 = $('#editEntre2').val();
        let editSuperManzana2 = $('#editSuperManzana2').val();
        let editManzana2 = $('#editManzana2').val();
        let editLote2 = $('#editLote2').val();
        let editMunicipio2 = $('#editMunicipio2').val();
        let editCodigoPostal2 = $('#editCodigoPostal2').val();
        let enveditobj = {
            titulo_env: editTitulo,
            estado_env: editEstado2,
            ciudad_env: editCiudad2,
            calle_env: editCalle2,
            entre_env: editEntre2,
            sm_env: editSuperManzana2,
            mza_env: editManzana2,
            lte_env: editLote2,
            municipio_env: editMunicipio2,
            cp_env: editCodigoPostal2
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${id}`,
            type: 'PUT',
            dataType: 'json',
            data: obj,
            beforeSend: () => {
                console.log('Subiendo archivo');
                $.ajax({
                    url: './imagen.php',
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'POST',
                    success: (r) => {
                        console.log('Subida de archivo exitosa');
                    }
                });
            },
            success: (r) => {
                location.reload();
            }
        });
        let facid = $('#second-tab-edit').attr('data-fac');
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/billaddress/${facid}`,
            type: 'PUT',
            dataType: 'json',
            data: faceditobj,
            success: (r) => {
                $('#editEstado').val(r.estado_fac);
                $('#editCiudad').val(r.ciudad_fac);
                $('#editCalle').val(r.calle_fac);
                $('#editEntre').val(r.entre_fac);
                $('#editSuperManzana').val(r.sm_fac);
                $('#editManzana').val(r.mza_fac);
                $('#editLote').val(r.lte_fac);
                $('#editMunicipio').val(r.municipio_fac);
                $('#editCodigoPostal').val(r.cp_fac);
            }
        });
        let envid = $('#third-tab-edit').attr('data-fac');
        $.ajax({
            url: ` https://erp-unid.herokuapp.com/api/clients/${id}/envios/`,
            type: 'PUT',
            dataType: 'json',
            data: faceditobj,
            success: (r) => {
                $('#editTitulo').val(r.titulo_env);
                $('#editEstado2').val(r.estado_env);
                $('#editCiudad2').val(r.ciudad_env);
                $('#editCalle2').val(r.calle_env);
                $('#editEntre2').val(r.entre_env);
                $('#editSuperManzana2').val(r.sm_env);
                $('#editManzana2').val(r.mza_env);
                $('#editLote2').val(r.lte_env);
                $('#editMunicipio2').val(r.municipio_env);
                $('#editCodigoPostal2').val(r.cp_env);
            }
        });
    });
    $('#insertCli').click(function(){
        // Clientes
        let cli_nombre = $('#nombreInsert').val();
        let cli_tel = $('#telInsert').val();
        let cli_correo = $('#correoInsert').val();
        let cli_idioma = $('#idiomaInsert').val();
        let cli_pais = $('#paisInsert').val();
        let cli_categoria = $('#catInsert').val();
        let cli_foto = $('#fotoInsert').val();
        let formData = new FormData();
        if(cli_foto != ''){
            let imagen = $('#fotoInsert').prop("files")[0];
            formData.append("file", imagen);
            cli_foto = $('#fotoInsert').val().replace(/C:\\fakepath\\/i, '');
        }
        let obj = {
            nombre_cli: cli_nombre,
            tel_cli: cli_tel,
            correo_cli: cli_correo,
            idioma_cli: cli_idioma,
            pais_cli: cli_pais,
            categoria_cli: cli_categoria,
            foto_cli: cli_foto
        };
        // Facturación
        let insertEstado = $('#insertEstado').val();
        let insertCiudad = $('#insertCiudad').val();
        let insertCalle = $('#insertCalle').val();
        let insertEntre = $('#insertEntre').val();
        let insertSuperManzana = $('#insertSuperManzana').val();
        let insertManzana = $('#insertManzana').val();
        let insertLote = $('#insertLote').val();
        let insertMunicipio = $('#insertMunicipio').val();
        let insertCodigoPostal = $('#insertCodigoPostal').val();
        let factobj = {
            estado_fac: insertEstado,
            ciudad_fac: insertCiudad,
            calle_fac: insertCalle,
            entre_fac: insertEntre,
            sm_fac: insertSuperManzana,
            mza_fac: insertManzana,
            lte_fac: insertLote,
            municipio_fac: insertMunicipio,
            cp_fac: insertCodigoPostal
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/billaddress`,
            type: 'POST',
            dataType: 'json',
            data: factobj,
            success: (r) => {
                let idresponse = r.id;
                obj.dir_fact_cli = idresponse;
                $.ajax({
                    url: `https://erp-unid.herokuapp.com/api/clients`,
                    type: 'POST',
                    dataType: 'json',
                    data: obj,
                    beforeSend: () => {
                        console.log('Subiendo archivo');
                        $.ajax({
                            url: './imagen.php',
                            contentType: false,
                            processData: false,
                            data: formData,
                            type: 'POST',
                            success: (r) => {
                                console.log('Subida de archivo exitosa');
                            }
                        });
                    },
                    success: (r) => {
                        getStartData();
                        $('#nombreInsert').val('');
                        $('#telInsert').val('');
                        $('#correoInsert').val('');
                        $('#idiomaInsert').val('');
                        $('#paisInsert').val('');
                        $('#catInsert').val('');
                        $('#fotoInsert').val('');
                        //fact campos
                        $('#insertEstado').val('');
                        $('#insertCiudad').val('');
                        $('#insertCalle').val('');
                        $('#insertEntre').val('');
                        $('#insertSuperManzana').val('');
                        $('#insertManzana').val('');
                        $('#insertLote').val('');
                        $('#insertMunicipio').val('');
                        $('#insertCodigoPostal').val('');
                        restartInsertForm();
                        location.reload();
                    }
                });
            }
        });
    });

    // INSERTAR DIRECCION DE ENVIO
    $('#insertEnv').click(function(){
        // Envío
        let idcliente = $('#saveDetails').attr('data-client');
        let insertTitulo = $('#insertTitulo').val();
        let insertEstado2 = $('#insertEstado2').val();
        let insertCalle2 = $('#insertCalle2').val();
        let insertEntre2 = $('#insertEntre2').val();
        let insertSuperManzana2 = $('#insertSuperManzana2').val();
        let insertManzana2 = $('#insertManzana2').val();
        let insertLote2 = $('#insertLote2').val();
        let insertMunicipio2 = $('#insertMunicipio2').val();
        let insertCodigoPostal2 = $('#insertCodigoPostal2').val();
        let envobj = {
            titulo_env: insertTitulo,
            estado_env: insertEstado2,
            calle_env: insertCalle2,
            entre_env: insertEntre2,
            sm_env: insertSuperManzana2,
            mza_env: insertManzana2,
            lte_env: insertLote2,
            municipio_env: insertMunicipio2,
            cp_env: insertCodigoPostal2
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${idcliente}/envios`,
            type: 'POST',
            dataType: 'json',
            data: envobj,
            success: (r) => {
                getStartDataEnv(idcliente);
                //env campos
                $('#insertTitulo').val('');
                $('#insertEstado2').val('');
                $('#insertCalle2').val('');
                $('#insertEntre2').val('');
                $('#insertSuperManzana2').val('');
                $('#insertManzana2').val('');
                $('#insertLote2').val('');
                $('#insertMunicipio2').val('');
                $('#insertCodigoPostal2').val('');
                restartInsertForm();
            }
        });
    });

    $('#envbody').on('click', '.get-dir-envio-data', function(){
        let idcliente = $('#saveDetails').attr('data-client');
        let idenvio = $(this).attr('data-envio');
        $('#editEnv').attr('data-envio', idenvio);
        $('#envioInsertBtns').hide();
        $('#envioEditBtns').show();
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${idcliente}/envios/${idenvio}`,
            type: 'GET',
            dataType: 'json',
            success: (r) => {
                // getStartDataEnv(idcliente);
                // env campos
                $('#insertTitulo').val(r.titulo_env);
                $('#insertEstado2').val(r.estado_env);
                $('#insertCalle2').val(r.calle_env);
                $('#insertEntre2').val(r.entre_env);
                $('#insertSuperManzana2').val(r.sm_env);
                $('#insertManzana2').val(r.mza_env);
                $('#insertLote2').val(r.lte_env);
                $('#insertMunicipio2').val(r.municipio_env);
                $('#insertCodigoPostal2').val(r.cp_env);
                // restartInsertForm();
            }
        });
    });

    $('#editEnv').click(function(){
        let idcliente = $('#saveDetails').attr('data-client');
        let idenvio = $(this).attr('data-envio');
        let insertTitulo = $('#insertTitulo').val();
        let insertEstado2 = $('#insertEstado2').val();
        let insertCalle2 = $('#insertCalle2').val();
        let insertEntre2 = $('#insertEntre2').val();
        let insertSuperManzana2 = $('#insertSuperManzana2').val();
        let insertManzana2 = $('#insertManzana2').val();
        let insertLote2 = $('#insertLote2').val();
        let insertMunicipio2 = $('#insertMunicipio2').val();
        let insertCodigoPostal2 = $('#insertCodigoPostal2').val();
        let envobj = {
            titulo_env: insertTitulo,
            estado_env: insertEstado2,
            calle_env: insertCalle2,
            entre_env: insertEntre2,
            sm_env: insertSuperManzana2,
            mza_env: insertManzana2,
            lte_env: insertLote2,
            municipio_env: insertMunicipio2,
            cp_env: insertCodigoPostal2
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/clients/${idcliente}/envios/${idenvio}`,
            type: 'PUT',
            dataType: 'json',
            data: envobj,
            success: (r) => {
                getStartDataEnv(idcliente);
                // env campos
                $('#insertTitulo').val('');
                $('#insertEstado2').val('');
                $('#insertCalle2').val('');
                $('#insertEntre2').val('');
                $('#insertSuperManzana2').val('');
                $('#insertManzana2').val('');
                $('#insertLote2').val('');
                $('#insertMunicipio2').val('');
                $('#insertCodigoPostal2').val('');
                $('#envioInsertBtns').show();
                $('#envioEditBtns').hide();
                // restartInsertForm();
            }
        });
    });

    $('#cancelEditEnv').click(function(){
        $('#envioInsertBtns').show();
        $('#envioEditBtns').hide();
        $('#insertTitulo').val('');
        $('#insertEstado2').val('');
        $('#insertCalle2').val('');
        $('#insertEntre2').val('');
        $('#insertSuperManzana2').val('');
        $('#insertManzana2').val('');
        $('#insertLote2').val('');
        $('#insertMunicipio2').val('');
        $('#insertCodigoPostal2').val('');
    });

    $('#nextTab').click(function(){
        // $('#envioInsert').val() != '' &&
        // $('#factInsert').val() != ''
        if(
            $('#nombreInsert').val() != '' &&
            $('#telInsert').val() != '' &&
            $('#correoInsert').val() != '' &&
            $('#idiomaInsert').val() != '' &&
            $('#paisInsert').val() != '' &&
            $('#catInsert').val() != ''
        ){
            changeBtn();
        }
    });
});

function restartInsertForm(){
    $('#first-tab').addClass('active');
    $('#second-tab').addClass('disabled');
    $('#second-tab').removeClass('active');
    $('#tab-eg5-0').addClass('active');
    $('#tab-eg5-1').removeClass('active');
    $('#nextTab').show();
    $('#insertCli').hide();
}

function changeBtn(){
    $('#first-tab').removeClass('active');
    $('#second-tab').removeClass('disabled');
    $('#second-tab').addClass('active');
    $('#tab-eg5-0').removeClass('active');
    $('#tab-eg5-1').addClass('active');
    $('#nextTab').hide();
    $('#insertCli').show();
}

function getStartData(){
    let template = '';
    $.ajax({
        url: `https://erp-unid.herokuapp.com/api/clicat`,
        type: 'GET',
        dataType: 'json',
        success: (r) => {
            $.each(r, function(index, value){
                template += `
                <tr>
                    <td>
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <div class="widget-content-left">
                                        <img width="40" class="rounded-circle" src="${ value.foto_cli }" alt="user-pic">
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">
                                        ${ value.nombre_cli }
                                    </div>
                                    <div class="widget-subheading opacity-7">
                                        ${ value.correo_cli }
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">${ value.pais_cli }</td>
                    <td class="text-center">
                        <div class="badge badge-info">${ value.categoria.nombre_cat }</div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm get-user-data" data-client="${ value.id_cli }" data-toggle="modal" data-target="#detallesModal">Editar</button>
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger delete-user-data" data-client="${ value.id_cli }" data-toggle="modal" data-target="#eliminarCliente"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                    </td>
                </tr>
                `;
            });
            $('#clitbody').html(template);
        }
    });
}

function getStartDataEnv(id){
    let template = '';
    $.ajax({
        url: `https://erp-unid.herokuapp.com/api/clients/${id}/envios`,
        type: 'GET',
        dataType: 'json',
        success: (r) => {
            $.each(r, function(index, value){
                template += `
                <tr>
                    <td>
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">
                                        ${ value.titulo_env }
                                    </div>
                                    <div class="widget-subheading opacity-7">
                                        ${ value.direccion_completa_env }
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="mx-auto border-0 btn btn-secondary d-block btn-sm get-dir-envio-data" data-envio="${ value.id_env }">
                            Editar
                        </button>
                    </td>
                </tr>
                `;
            });
            $('#envbody').html(template);
        },
        error: () => {
            $('#envbody').html('<tr><td colspan="2"><div class="text-center">No hay direcciones de envío disponibles. Intenta agregando una nueva.</div><td></tr>');
        }
    });
}
