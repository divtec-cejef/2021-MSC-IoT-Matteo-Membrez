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

    $date_message = date('Y-m-d H:i:s', $data['Date']);
    $seq_num_message = $data['Numéro de séquence'];
    $temperature_message = $data['Température'];
    $humidite_message = $data['Humidité'];

    $lastID = addNewValues($date_message, $seq_num_message, $temperature_message, $humidite_message);

    $data = [];
    $data['id'] = $lastID;
    http_response_code(201);
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
