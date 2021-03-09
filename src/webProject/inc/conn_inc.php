<?php

// Fonction de connexion à la base de données
function connDB($base) {

    $user='1v2ue_membmat';
    $pass='iZSfTMuo_SIK';

    $dsn='mysql:host=1v2ue.myd.infomaniak.com;dbname='.$base.';charset=UTF8';

    try {

        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;

    } catch (PDOException $e) {
        print "erreur ! :". $e->getMessage()."<br/>";
        die();
    }


}
