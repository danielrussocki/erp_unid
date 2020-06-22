$(document).ready(function(){
    // Click categorias detalles
    // Se usa on para activarlo en el DOM
    // Si se usa solo click en este caso, no funciona
    $('#catstbody').on('click', '.get-cats-data', function(){
        let id = $(this).data('cat');
        $('#saveCats').attr('data-cat', id);
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/categories/${id}`,
            type: 'GET',
            dataType: 'json',
            success: (r) => {
                $('#saveCats').prop('disabled', false);
                $('#nombre').val(r.nombre_cat);
            }
        });
    });
    $('#catstbody').on('click', '.delete-cats-data', function(){
        let id = $(this).data('cat');
        $('#btnEliminarCat').attr('data-cat', id);
    });
    $('#btnEliminarCat').click(function(){
        let id = $('#btnEliminarCat').attr('data-cat');
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/categories/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: (r) => {
                location.reload();
            }
        });
    });
    $('#detallesCategorias').on('click', '#saveCats', function(e){
        console.log($(this));
        let id = $(this).attr('data-cat');
        let cat_nombre = $('#nombre').val();
        let obj = {
            nombre_cat: cat_nombre
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/categories/${id}`,
            type: 'PUT',
            dataType: 'json',
            data: obj,
            success: (r) => {
                location.reload();
            }
        });
    });
    $('#insertCat').click(function(){
        let cat_nombre = $('#nombreInsert').val();
        let obj = {
            nombre_cat: cat_nombre
        };
        $.ajax({
            url: `https://erp-unid.herokuapp.com/api/categories`,
            type: 'POST',
            dataType: 'json',
            data: obj,
            success: (r) => {
                // getStartData();
                // $('#nombreInsert').val('');
                location.reload();
            }
        });
    });
});

function getStartData(){
    let template = '';
    $.ajax({
        url: `https://erp-unid.herokuapp.com/api/categories`,
        type: 'GET',
        dataType: 'json',
        success: (r) => {
            $.each(r, function(index, value){
                template += `
                <tr>
                    <td class="text-center">${value.nombre_cat}</td>
                    <td class="text-center">
                        <!-- ###### El botón debería mandarnos a editar el usuario ####### -->
                        <button type="button" class="btn btn-primary btn-sm get-cats-data" data-cat="${value.id_cat}" data-toggle="modal" data-target="#detallesCategorias">Editar</button>
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger delete-cats-data" data-cat="${value.id_cat}" data-toggle="modal" data-target="#eliminarCategoria"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                    </td>
                </tr>
                `;
            });
            $('#catstbody').html(template);
        }
    });
}