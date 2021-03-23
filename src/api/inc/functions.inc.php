<?php

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* GET **************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * @return false|PDOStatement toutes les valeurs de chaque capteurs
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
	            INNER JOIN tb_message ON tb_capteur.pk_id_capteur = tb_message.fk_id_capteur
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

/**
 * Récupère toutes les valeurs d'un capteur par son identifiant
 * @param $id l'identifiant du capteur dont on veut récupérer les valeurs
 * @return false|PDOStatement un tableau d'enregistrement
 */
function getValuesById($id) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT tb_capteur.nom_capteur, tb_capteur.num_id_capteur, tb_salle.nom_salle, tb_message.seq_num_message, tb_message.temperature_message, tb_message.humidite_message, tb_message.date_message
                FROM tb_capteur 
	            INNER JOIN tb_salle ON tb_capteur.fk_id_salle = tb_salle.pk_id_salle 
	            INNER JOIN tb_message ON tb_capteur.pk_id_capteur = tb_message.fk_id_capteur
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

/**
 * @return false|PDOStatement toutes les salles
 */
function getAllSalles() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT nom_salle FROM tb_salle";

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

/**
 * @param $name_salle le nom de la salle à rechercher
 * @return false|PDOStatement la salle recherchée
 */
function getValuesBySalles($name_salle) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT tb_capteur.nom_capteur, tb_capteur.num_id_capteur, tb_salle.nom_salle, tb_message.seq_num_message, tb_message.temperature_message, tb_message.humidite_message, tb_message.date_message
                FROM tb_capteur 
	            INNER JOIN tb_salle ON tb_capteur.fk_id_salle = tb_salle.pk_id_salle 
	            INNER JOIN tb_message ON tb_capteur.pk_id_capteur = tb_message.fk_id_capteur
	            WHERE tb_salle.nom_salle = :name_salle
	            ORDER BY tb_message.seq_num_message DESC";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':name_salle', $name_salle, PDO::PARAM_INT);

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

/**
 * @return false|PDOStatement tous les capteurs avec leurs salles
 */
function getAllCapteur() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT nom_capteur, num_id_capteur, tb_salle.nom_salle FROM tb_capteur
                INNER JOIN tb_salle ON tb_capteur.fk_id_salle = tb_salle.pk_id_salle ";

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

/**
 * @return false|PDOStatement tous les messages avec leur capteur
 */
function getAllMessage() {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT date_message, seq_num_message, temperature_message, humidite_message, nom_capteur FROM tb_message
                INNER JOIN tb_capteur ON tb_message.fk_id_capteur = tb_capteur.pk_id_capteur ";

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

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* POST *************************************************************************** */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * Ajoute une nouvelle mesure à la base de données
 * @param $date_message La date du message
 * @param $seq_num_message Le numéro de séquence du message
 * @param $temperature_message La mesure de la température
 * @param $humidite_message La mesure de l'humidité
 * @param $fk_id_capteur La clé étrangère qui représente le capteur
 * @return string Le dernier identifiant inséré
 */
function addNewValues($date_message, $seq_num_message, $temperature_message, $humidite_message, $fk_id_capteur) {
    try {
        // insertion des donnnées dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "INSERT INTO tb_message(date_message, seq_num_message, temperature_message, humidite_message, fk_id_capteur) 
                VALUES (:date_message, :seq_num_message, :temperature_message, :humidite_message, :fk_id_capteur);";

        // préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        // association du marqueur à une variable (E/S)
        $stmt->bindParam(':date_message', $date_message);
        $stmt->bindParam(':seq_num_message', $seq_num_message, PDO::PARAM_INT);
        $stmt->bindParam(':temperature_message', $temperature_message);
        $stmt->bindParam(':humidite_message', $humidite_message, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_capteur', $fk_id_capteur, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

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

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* DELETE ************************************************************************* */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * Supprime le message du numéro de séquence indiqué
 * @param $num_seq Le numéro de séquence de la valeur a supprimer
 * @return false|PDOStatement
 */
function deleteValueBySequence($num_seq) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "DELETE FROM tb_message WHERE seq_num_message = :num_seq";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':num_seq', $num_seq, PDO::PARAM_INT);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $nbModification = $stmt->rowCount();

        if ($nbModification >0) {
            return $nbModification . ' utilisateur supprimé';
        } else {
            return 'aucun utilisateur supprimé';
        }

    } catch (PDOException $e) {
        die($e->getMessage());
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ********************************************************************* UPDATE ************************************************************************* */
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * Mets à jour la valeur du numéro de séquence indiqué
 * @param $num_seq Le numéro de séquence du message à modifier
 * @param $temperature_message la nouvelle mesure de la température
 * @param $humidite_message la nouvelle mesure de l'humidité
 * @return int Le nombre de lignes affectées par la requête
 */
function updateValueBySequence($num_seq ,$temperature_message, $humidite_message) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "UPDATE tb_message SET
                temperature_message = :temperature_message,
                humidite_message = :humidite_message
                WHERE seq_num_message = :num_seq;";

        //préparation de la requête sur le serveur
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':num_seq', $num_seq, PDO::PARAM_INT);
        $stmt->bindParam(':temperature_message', $temperature_message);
        $stmt->bindParam(':humidite_message', $humidite_message, PDO::PARAM_INT);

        //exécution de la requête
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        return $stmt->rowCount();

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

/**
 * Vérifie que l'appareil existe
 * @param $device le nom de l'appareil
 * @return mixed l'identifiant du capteur
 */
function verifyDevice($device) {
    // récupération de tous les enregistrements
    try {
        // insertion des données dans la base de données
        $dbh = connDB(DB_NAME);

        // modèle de requête
        $sql = "SELECT pk_id_capteur FROM tb_capteur
                WHERE num_id_capteur LIKE :device";

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
    return $stmt->fetch();
}

/**
 * Convert an epoch time to a DateTime
 * @param $time epoch time to convert
 * @return the converted value
 */
function convertEpoch($time) {
    $formatedTime = new DateTime("@$time");

    // Add one hour to correct time timezone problems
    date_add($formatedTime, date_interval_create_from_date_string('1 hour'));

    return $formatedTime->format('Y-m-d H:i:s');
}