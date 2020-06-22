<?php
require "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";

if ($_POST) {
    switch ($_POST['action']) {
        case 'insertar':insertar();
            break;

        case 'eliminar':eliminar($_POST["id_cli"]);
            break;

        case 'consultar':consultar($_POST["id_cli"]);
            break;

        case 'editar':editar($_POST["id_cli"]);
            break;
    }
}

function insertar() {
    global $db;
    $db->insert("vacantes", [
        "titulo_vac" => $_POST["titulo_vac"],
        "estado_vac" => $_POST["estado_vac"],
        "departamento_vac" => $_POST["departamento_vac"],
        "jornada_vac" => $_POST["jornada_vac"],
        "edad_vac" => $_POST["edad_vac"],
        "sueldo_vac" => $_POST["sueldo_vac"],
        "ofrecemos_vac" => $_POST["ofrecemos_vac"],
        "experiencia_vac" => $_POST["experiencia_vac"]
    ]);
    $res["status_vac"] = 1;
    echo json_encode($res);
}

function eliminar($id_cli) {
    global $db;
    $db->delete("vacantes", ["id_cli" => $id_cli]);
    $res["status_vac"] = 1;
    echo json_encode($res);
}

function consultar($id_cli) {
    global $db;

    $sql = $db->get("vacantes", "*", ["id_cli" => $_POST["id_cli"]]);
    $datos = array();

    $datos[] = array(
        "titulo_vac" => $sql["titulo_vac"],
        "estado_vac" => $sql["estado_vac"],
        "departamento_vac" => $sql["departamento_vac"],
        "jornada_vac" => $sql["jornada_vac"],
        "edad_vac" => $sql["edad_vac"],
        "sueldo_vac" => $sql["sueldo_vac"],
        "experiencia_vac" => $sql["experiencia_vac"],
        "ofrecemos_vac" => $sql["ofrecemos_vac"],
        "id_cli" => $sql["id_cli"]
    );

    echo json_encode($datos);
}

function editar($id_cli) {
    global $db;
    $db->update(
        "vacantes",
        [
            "titulo_vac" => $_POST["titulo_vac"],
            "estado_vac" => $_POST["estado_vac"],
            "departamento_vac" => $_POST["departamento_vac"],
            "jornada_vac" => $_POST["jornada_vac"],
            "edad_vac" => $_POST["edad_vac"],
            "sueldo_vac" => $_POST["sueldo_vac"],
            "experiencia_vac" => $_POST["experiencia_vac"],
            "ofrecemos_vac" => $_POST["ofrecemos_vac"]
        ],
        ["id_cli" => $id_cli]
    );
    $res["status_vac"] = 1;

    echo json_encode($res);
}