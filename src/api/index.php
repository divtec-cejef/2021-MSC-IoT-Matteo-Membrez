<?php
/**
 * Created by PhpStorm.
 * User: lmo
 * Date: 19.01.18
 * Time: 20:08
 */

require_once 'router.php';
require  __DIR__ . 'inc/config.inc.php';
require  __DIR__ . 'inc/conn_inc.php';

// récupère l'url partielle vers le dossier en cours
$sub_dir = dirname($_SERVER['PHP_SELF']);

/**

* usage: http://.../demo/router/books
*/

route('get', $sub_dir . '/hello', function ($matches, $rxd) {

    connDB(DB_NAME);

    $data = [
        "method" => 'get', // pour démo
    ];


    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});


/**
 * usage: http://.../demo/router/books/1
 */
route('get', $sub_dir . '/hello/([0-9]+)', function ($matches, $rxd) {
    $id = $matches[1][0];
    $data = [
        "method" => 'get', // pour démo
        "id"     => $id
    ];


    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});


/**
 * usage: http://.../demo/router/books
 * + data passée x-www-form-urlencode
 */
route('post', $sub_dir . '/hello', function ($matches, $rxd) {

    // pour démo
    $data = [
        "method" => 'post'
    ];
    $data = array_merge($data, $rxd);

    http_response_code(201);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});




/**
 * usage: http://.../demo/router/books/
 * + data passée x-www-form-urlencode
 */
route('put', $sub_dir . '/hello/([0-9]+)', function ($matches, $rxd) {
    $id = $matches[1][0];

    $data = [
        "method" => 'put', // pour démo
        "id"     => $id
    ];
    $data = array_merge($data, $rxd);

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});



/**
 * usage: http://../demo/router/books/1
 */
route('delete', $sub_dir . '/hello/([0-9]+)', function ($matches, $rxd) {
    $id = $matches[1][0];
    $data = [
        "method" => 'delete', // pour démo
        "id"     => $id
    ];


    http_response_code(202);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
});



// si l'url ne correspond à aucune route
$data = [];
$data = [
   "error"     => "Route invalide"
];

http_response_code(400);
header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
