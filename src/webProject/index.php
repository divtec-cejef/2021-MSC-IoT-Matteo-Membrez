<?php

// Chargement de la configuration
require 'inc/config.inc.php';
require 'inc/conn_inc.php';

$json = file_get_contents('http://membmat.divtec.me/iot/api/values');
$values = json_decode($json, JSON_OBJECT_AS_ARRAY);

require VIEW_DIR . 'index.view.php';
