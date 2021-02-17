<?php
/**
 * Created by PhpStorm.
 * User: lmo
 * Date: 19.01.18
 * Time: 20:08
 */

require_once 'router.php';
require  'inc/config.inc.php';
require  'inc/conn_inc.php';
require 'inc/functions.inc.php';

// récupère l'url partielle vers le dossier en cours
$sub_dir = dirname($_SERVER['PHP_SELF']);

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* GET **************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* Salles ************************************************************************* */

/**
 * usage: http://.../iot/api/salles
 */
route('get', $sub_dir . '/salles', function ($matches, $rxd) {

    $data = getAllSalles()->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/**
 * usage: http://.../iot/api/salles/([0-9]+)
 */
route('get', $sub_dir . '/salles/([0-9]+)', function ($matches, $rxd) {

    $id = $matches[1][0];

    $data = getSallesById($id)->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* CAPTEURS *********************************************************************** */

/**
 * usage: http://.../iot/api/capteurs
 */
route('get', $sub_dir . '/capteurs', function ($matches, $rxd) {

    $data = getAllCapteurs()->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/**
 * usage: http://.../iot/api/capteurs/([0-9]+)
 */
route('get', $sub_dir . '/capteurs/([0-9]+)', function ($matches, $rxd) {

    $id = $matches[1][0];

    $data = getCapteursById($id)->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* MESSAGES *********************************************************************** */

/**
 * usage: http://.../iot/api/messages
 */
route('get', $sub_dir . '/messages', function ($matches, $rxd) {

    $data = getAllMessages()->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/**
 * usage: http://.../iot/api/messages/([0-9]+)
 */
route('get', $sub_dir . '/messages/([0-9]+)', function ($matches, $rxd) {

    $id = $matches[1][0];

    $data = getMessagesById($id)->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* POST *************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

// si l'url ne correspond à aucune route
$data = [];
$data = [
   "error"     => "Route invalide"
];

http_response_code(400);
header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
