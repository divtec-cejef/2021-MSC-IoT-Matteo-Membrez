<?php

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* GET **************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* SALLES ************************************************************************* */

// Récupère toutes les salles
function getAllSalles() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_salle, nom_salle FROM tb_salle";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}

// Récupère une salle par son identifiant
function getSallesById($id) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_salle, nom_salle FROM tb_salle
                WHERE tb_salle.pk_id_salle = :id";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* CAPTEURS *********************************************************************** */

// Récupère tous les capteurs
function getAllCapteurs() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_capteur, nom_capteur, num_id_capteur, fk_id_salle, fk_id_message FROM tb_capteur";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}

// Récupère le capteur par son identifiant
function getCapteursById($id) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_capteur, nom_capteur, num_id_capteur, fk_id_salle, fk_id_message FROM tb_capteur
                WHERE tb_capteur.pk_id_capteur = :id";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ********************************************************************* MESSAGES *********************************************************************** */

// Retourne tous les messages
function getAllMessages() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_message, date_message, seq_num_message, temperature_message, humidite_message FROM tb_message";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}

// Récupère le message par son identifiant
function getMessagesById($id) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_message, date_message, seq_num_message, temperature_message, humidite_message FROM tb_message
                WHERE tb_message.pk_id_message = :id";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    // retourne un tableau d'enregistrement ou le $stmt
    return $stmt;
}
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* POST *************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
