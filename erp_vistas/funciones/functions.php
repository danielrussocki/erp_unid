<?php
require "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";

if($_POST){
    switch($_POST['acciones']){
        case 'insert-postulante':
            extract($_POST);
            if(
                trim($vacante_post) == "" ||
                trim($nombre_post) == "" ||
                trim($correo_post) == "" ||
                trim($cv_post) == "" ||
                !filter_var($correo_post, FILTER_VALIDATE_EMAIL)
            ){
                $respuesta["status"] = 0;
            } else {
                $db->insert("postulantes", [
                    "nombre_post" => trim($nombre_post),
                    "correo_post" => trim($correo_post),
                    "telefono_post" => trim($telefono_post),
                    "cv_post" =>"assets/cvs/". trim($cv_post),
                    "descripcion_post" => trim($descripcion_post),
                    "vacante_post" => trim($vacante_post)
                ]);
                $respuesta["status"] = 1;
            }
            echo json_encode($respuesta);
        break;
    }
}
?>