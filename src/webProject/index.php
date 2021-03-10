<?php

// Chargement de la configuration
require 'inc/config.inc.php';
require 'inc/conn_inc.php';

// Décode le résultat reçu en format JSON lors de l'appelle de l'API
// et le stock dans un tableau
$json = file_get_contents('http://membmat.divtec.me/iot/api/values');
$values = json_decode($json, JSON_OBJECT_AS_ARRAY);

require VIEW_DIR . 'index.view.php';
