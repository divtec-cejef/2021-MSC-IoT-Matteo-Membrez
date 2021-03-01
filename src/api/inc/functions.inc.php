<?php

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* GET **************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * Retourne toutes les valeurs
 * nom_capteur : Le nom du capteur
 * num_id_capteur : Le numéro identifiant du capteur
 * nom_salle : Nom de la salle où se trouve le capteur
 * seq_num_message : Le numéro de séquence du message
 * temperature_message : La mesure de la température
 * humidite_message : La mesure de l'humidité
 * date_message : La date et l'heure de la mesure
 */
function getAllValues() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT tb_capteur.nom_capteur, tb_capteur.num_id_capteur, tb_salle.nom_salle, tb_message.seq_num_message, tb_message.temperature_message, tb_message.humidite_message, tb_message.date_message
                FROM tb_capteur 
	            INNER JOIN tb_salle ON tb_capteur.fk_id_salle = tb_salle.pk_id_salle 
	            INNER JOIN tb_message ON tb_capteur.fk_id_message = tb_message.pk_id_message
	            ORDER BY tb_message.seq_num_message DESC";

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

// Récupère toutes les valeurs d'un capteur par son identifiant
function getValuesById($id) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT tb_capteur.nom_capteur, tb_capteur.num_id_capteur, tb_salle.nom_salle, tb_message.seq_num_message, tb_message.temperature_message, tb_message.humidite_message, tb_message.date_message
                FROM tb_capteur 
	            INNER JOIN tb_salle ON tb_capteur.fk_id_salle = tb_salle.pk_id_salle 
	            INNER JOIN tb_message ON tb_capteur.fk_id_message = tb_message.pk_id_message
	            WHERE tb_capteur.pk_id_capteur = :id
	            ORDER BY tb_message.seq_num_message DESC";

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

/**
 * Ajoute une nouvelle mesure à la base de données
 */
function addNewValues($date_message, $seq_num_message, $temperature_message, $humidite_message) {
    try {
        // insertion des donnnées dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "INSERT INTO tb_message(date_message, seq_num_message, temperature_message, humidite_message) 
                VALUES (:date_message, :seq_num_message, :temperature_message, :humidite_message);";

        // préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        // association du marqueur à une variable (E/S)
        $stmt->bindParam(':date_message', $date_message);
        $stmt->bindParam(':seq_num_message', $seq_num_message, PDO::PARAM_INT);
        $stmt->bindParam(':temperature_message', $temperature_message);
        $stmt->bindParam(':humidite_message', $humidite_message, PDO::PARAM_INT);

        // exécution de la requête
        $stmt->execute();

        // retourne le dernier index inseré.
        return $dbh->lastInsertId();

    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

// Vérifie que l'appareil existe
function verifyDevice($device) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_capteur FROM tb_capteur
                WHERE nom_capteur LIKE :device";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':device', $device);

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
