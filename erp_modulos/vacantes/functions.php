<?php

include("../../includes/_funciones.php");
$seccion_actual = "vacantes";
if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar':guardar();
            break;

        case 'listar':listar();
            break;

        case 'eliminar':eliminar();
            break;

        case 'consultar':consultar();
            break;

        case 'editar':editar();
            break;

        case 'eliminar_imagen':eliminar_imagen();
            break;

        case 'ver':ver();
            break;
        
        case 'destacar':destacar();
            break;
    }
}

function guardar() {
    $url = replaceUrl($_POST['titulo']);
    $experiencia = str_replace ("'", "’", $_POST['experiencia']);
    $ofrecemos = str_replace ("'", "’", $_POST['ofrecemos']);
    $fecha = date("Y-m-d");
    mysql_query("SET NAMES 'utf8'");
    global $link;
    $sql = "INSERT INTO vacantes values('', '" . $_POST['titulo'] . "', '" . $_POST['estado'] . "', '" . $_POST['area'] . "', '" . $_POST['jornada'] . "', '" . $_POST['edad'] . "', '" . $_POST['sueldo'] . "', '" . $experiencia . "', '" . $ofrecemos . "', '" . $url . "', ".time().", '')";
    mysql_query($sql, $link);
}

function listar() {
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM vacantes 
    INNER JOIN estados ON estado_vac = id_est 
    INNER JOIN areas ON area_vac = id_are 
    ORDER BY id_vac DESC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'titulo' => $rows['titulo_vac'],
            'area' => $rows['nombre_are'],
            'estado' => $rows['nombre_est'],
            'status' => $rows['status_vac'],
            'id' => $rows['id_vac']
        );
    }

    echo json_encode($datos);
}

function eliminar() {
    global $link;
    $sql = "DELETE FROM vacantes WHERE id_vac = '" . $_POST['id'] . "'";
    mysql_query($sql, $link);
}

function consultar() {
    mysql_query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM vacantes WHERE id_vac = '" . $_POST['id'] . "'";

    $query = mysql_query($sql);
    $datos = array();
    $rows = mysql_fetch_array($query);

    $datos[] = array(
        'titulo' => $rows['titulo_vac'],
        'estado' => $rows['estado_vac'],
        'area' => $rows['area_vac'],
        'jornada' => $rows['jornada_vac'],
        'edad' => $rows['edad_vac'],
        'sueldo' => $rows['sueldo_vac'],
        'experiencia' => $rows['experiencia_vac'],
        'ofrecemos' => $rows['ofrecemos_vac'],
        'id' => $rows['id_vac']
    );

    $_SESSION["noticia_editada"] = $rows['id_vac'];

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function editar() {
    $url = replaceUrl($_POST['titulo']);
    global $link;
    mysql_query("SET NAMES 'utf8'");
    if (isset($_POST['remimg'])) {
        eliminar_imagen($_POST['remimg']);
    }
    $experiencia = str_replace ("'", "’", $_POST['experiencia']);
    $ofrecemos = str_replace ("'", "’", $_POST['ofrecemos']);
    $sql = "
	UPDATE vacantes 
	SET 
        titulo_vac = '" . $_POST['titulo'] . "',
        estado_vac = '" . $_POST['estado'] . "', 
        area_vac = '" . $_POST['area'] . "',
        jornada_vac = '" . $_POST['jornada'] . "',
        edad_vac = '" . $_POST['edad'] . "',
        sueldo_vac = '" . $_POST['sueldo'] . "',
        experiencia_vac = '" . $experiencia . "',
        ofrecemos_vac = '" . $ofrecemos . "',
        url_vac = '" . $url . "'
	WHERE 
	id_vac='" . $_SESSION['noticia_editada'] . "'";
    echo $sql;
    mysql_query($sql, $link);
}

function eliminar_imagen($img) {
    global $link;

    $fotos = explode('**', $img);

    for ($i = 0; $i < count($fotos); $i++) {
        if ($fotos[$i] !== "") {
            unlink('../../../img/vacantes/' . $fotos[$i]);
            unlink('../../../img/vacantes/thumb/' . $fotos[$i]);
        }
    }
}

function ver() {
    global $link;
    if ($_POST['activo'] === "0") {
        $activo = "1";
    } else {
        $activo = "0";
    }
    $sql = "
	UPDATE vacantes 
	SET 
        status_vac = '" . $activo . "'
	WHERE 
	id_vac='" . $_POST['id'] . "'";

    mysql_query($sql, $link);
}

function destacar() {
    global $link;
    if ($_POST['activo'] === "0") {
        $activo = "1";
    } else {
        $activo = "0";
    }
    $sql = "
	UPDATE vacantes 
	SET 
        destacado_vac = '" . $activo . "'
	WHERE 
	id_vac='" . $_POST['id'] . "'";

    mysql_query($sql, $link);
}