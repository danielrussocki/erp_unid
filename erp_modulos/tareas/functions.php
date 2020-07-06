<?php
require "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";

if ($_POST) {
    switch ($_POST['action']) {
        case 'insertar':insertar();
            break;

        case 'eliminar':eliminar($_POST["id_tar"]);
            break;

        case 'consultar':consultar($_POST["id_tar"]);
            break;

        case 'editar':editar($_POST["id_tar"]);
            break;

        case 'detalles-tarea':detallesTareas($_POST["id_tar"]);
            break;

        case 'iniciar-tarea':cambiarStatusTarea(1, $_POST['id_tar']);
            break;

        case 'pausar-tarea':cambiarStatusTarea(2, $_POST['id_tar']);
            break;

        case 'reanudar-tarea':cambiarStatusTarea(3, $_POST['id_tar']);
            break;

        case 'terminar-tarea':cambiarStatusTarea(4, $_POST['id_tar']);
            break;
    }
}

function insertar() {
    global $db;
    $db->insert("tareas", [
        "desc_tar" => $_POST["desc_tar"],
        "usr_tar" => $_POST["usr_tar"],
        "usr2_tar" => $_POST["usr2_tar"],
        "fechaasig_tar" => $_POST["fechaasig_tar"],
        "status_tar" => $_POST["status_tar"]
    ]);
    $res["activo_tar"] = 1;
    echo json_encode($res);
}

function eliminar($id_tar) {
    global $db;
    $db->delete("tareas", ["id_tar" => $id_tar]);
    $res["activo_tar"] = 1;
    echo json_encode($res);
}

function consultar($id_tar) {
    global $db;

    $sql = $db->get("tareas", "*", ["id_tar" => $_POST["id_tar"]]);
    $datos = array();

    $datos[] = array(
        "desc_tar" => $sql["desc_tar"],
        "usr_tar" => $sql["usr_tar"],
        "usr2_tar" => $sql["usr2_tar"],
        "fechaasig_tar" => $sql["fechaasig_tar"],
        "status_tar" => $sql["status_tar"],
        // "sueldo_tar" => $sql["sueldo_tar"],
        // "experiencia_tar" => $sql["experiencia_tar"],
        // "ofrecemos_tar" => $sql["ofrecemos_tar"],
        "id_tar" => $sql["id_tar"]
    );

    echo json_encode($datos);
}

function editar($id_tar) {
    global $db;
    $db->update(
        "tareas",
        [
            "desc_tar" => $_POST["desc_tar"],
            "usr_tar" => $_POST["usr_tar"],
            "usr2_tar" => $_POST["usr2_tar"],
            "fechaasig_tar" => $_POST["fechaasig_tar"],
            "status_tar" => $_POST["status_tar"],
            // "sueldo_tar" => $_POST["sueldo_tar"],
            // "experiencia_tar" => $_POST["experiencia_tar"],
            // "ofrecemos_tar" => $_POST["ofrecemos_tar"]
        ],
        ["id_tar" => $id_tar]
    );
    $res["activo_tar"] = 1;

    echo json_encode($res);
}

function detallesTareas($id){
    global $db;
    $detalles = $db->select("tiempo_tarea", "*", [
        "tarea_id" => $id
    ]);
    echo json_encode($detalles);
}

function cambiarStatusTarea($actionNumber, $id){
    global $db;
    switch($actionNumber){
        case 1:
            $db->update("tareas", [
                "status_tar" => "Iniciado"
            ], [
                "id_tar" => $id
            ]);
            $response["status"] = 1;
            echo json_encode($response);
        break;
        case 2:
            $db->update("tareas", [
                "status_tar" => "Pausado"
            ], [
                "id_tar" => $id
            ]);
            $response["status"] = 1;
            echo json_encode($response);
        break;
        case 3:
            $db->update("tareas", [
                "status_tar" => "Iniciado"
            ], [
                "id_tar" => $id
            ]);
            $response["status"] = 1;
            echo json_encode($response);
        break;
        case 4:
            $db->update("tareas", [
                "status_tar" => "Completado"
            ], [
                "id_tar" => $id
            ]);
            $response["status"] = 1;
            echo json_encode($response);
        break;
    }
}