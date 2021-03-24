<?php

// Chargement de la configuration
require 'inc/config.inc.php';
require 'inc/conn_inc.php';

require 'model/index.model.php';

// Décode le résultat reçu en format JSON lors de l'appelle de l'API
// et le stock dans un tableau
if(isset($_GET['salle'])) {
    $json = file_get_contents('http://membmat.divtec.me/iot/api/salles/' . $_GET['salle']);
} else {
    $json = file_get_contents('http://membmat.divtec.me/iot/api/values');
}

$values = json_decode($json, JSON_OBJECT_AS_ARRAY);

// récuperation de l'action passée en get
$act = filter_input(INPUT_GET, 'act',FILTER_SANITIZE_STRING);

if(isset($act) && $act==='del') {
    $api_url = 'http://membmat.divtec.me/iot/api/values/' . $_GET['id'];
    $result = CallAPI('DELETE', $api_url);
    header('location:index.php');
}

if(isset($act) && $act==='upd') {

    // initialisation des variables
    $errors = [];
    $temperature = '';
    $humidite = '';

    if(isset($_POST['z_frm'])) {

        // la température est invalide
        if(empty($_POST['z_temperature']))
            $errors[] = "La température doit être renseignée";

        else {
            $temperature = $_POST['z_temperature'];
        }

        // l'humidité est invalide
        if(empty($_POST['z_humidite']))
            $errors[] = "L'humidité doit être renseignée";
        else {
            $humidite = $_POST['z_humidite'];
        }

        // vérifier qu'aucune erreur ne soit survenue
        if(empty($errors) === true) {
            // appelle de la fonction de modification
            $api_url = 'http://membmat.divtec.me/iot/api/values/' . $_GET['id'];

            $data = array('Température' => $_POST['z_temperature'], 'Humidité' => $_POST['z_humidite']);

            $result = CallAPI('PUT', $api_url, $data);
            header('location:index.php');

        } else {
            // présente la vue de mise à jour
            include VIEW_DIR . 'update.view.php';
            exit();
        }
    } else {

        include VIEW_DIR . 'update.view.php';
        exit();
    }
}

require VIEW_DIR . 'index.view.php';
