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

// Affiche toutes les valeurs de tous les capteurs
route('get', $sub_dir . '/values', function ($matches, $rxd) {

    $data = getAllValues()->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

// Affiche toutes les valeurs d'un capteur désigné
route('get', $sub_dir . '/values/([0-9]+)', function ($matches, $rxd) {

    $id = $matches[1][0];

    $data = getValuesById($id)->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

// Affiche toutes les salles
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

// Affiche toutes les valeurs d'un capteur désigné
route('get', $sub_dir . '/salles/([A-Z-a-z-0-9]+)', function ($matches, $rxd) {

    $name_salle = $matches[1][0];

    $data = getValuesBySalles($name_salle)->fetchAll();

    if(empty($data)) {
        http_response_code(404);
    } else {
        http_response_code(200);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

// Affiche tous les capteurs
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

// Affiche tous les messages
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

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* POST *************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

route('post', $sub_dir . '/values', function ($matches, $rxd) {

    $json = file_get_contents("php://input");
    $postData = json_decode($json, true);

    // pour démo
    $data = [];

    $data = array_merge($data, $postData);

    $date_message = convertEpoch($data['Date']);
    $seq_num_message = $data['Numéro de séquence'];
    $temperature_message = $data['Température'];
    $humidite_message = $data['Humidité'];
    $nom_capteur = $data['ID du capteur'];
    $id_capteur = verifyDevice($nom_capteur);

    var_dump($date_message);

    $lastID = addNewValues($date_message, $seq_num_message, $temperature_message, $humidite_message, $id_capteur['pk_id_capteur']);

    $data = [];
    $data['id'] = $lastID;
    http_response_code(201);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* DELETE ************************************************************************* */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

route('delete', $sub_dir . '/values/([0-9]+)', function ($matches, $rxd) {

    $num_seq = $matches[1][0];

    $lastID = deleteValueBySequence($num_seq);

    $data['id'] = $lastID;

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
/* ********************************************************************* DELETE ************************************************************************* */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

route('put', $sub_dir . '/values/([0-9]+)', function ($matches, $rxd) {

    $json = file_get_contents("php://input");
    $postData = json_decode($json, true);

    $num_seq = $matches[1][0];

    // pour démo
    $data = [];

    $data = array_merge($data, $postData);

    $temperature_message = $data['Température'];
    $humidite_message = $data['Humidité'];

    $lastID = updateValueBySequence($num_seq, $temperature_message, $humidite_message);

    $data = [];
    $data['id'] = $lastID;
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

// si l'url ne correspond à aucune route
$data = [];
$data = [
   "error"     => "Route invalide"
];

http_response_code(400);
header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
