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

// si l'url ne correspond à aucune route
$data = [];
$data = [
   "error"     => "Route invalide"
];

http_response_code(400);
header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
