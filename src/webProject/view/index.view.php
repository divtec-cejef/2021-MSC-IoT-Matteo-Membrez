<?php ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Atelier IoT</title>
</head>
<body>
<main>

    <div id="map">
        <img src="../img/map.jpg" alt="The map" usemap="#plan">

        <map name="plan">
            <area target="" alt="B1-15" title="B1-15" href="?salle=B1-15" coords="20,23,252,281" shape="rect">
            <area target="" alt="B1-04" title="B1-04" href="?salle=B1-04" coords="21,283,252,384" shape="rect">
            <area target="" alt="B1-13" title="B1-13" href="?salle=B1-13" coords="449,282,679,500" shape="rect">
        </map>
    </div>

    <div id="content">
        <div id="temp">
            <p><?php echo $values[0]['nom_salle']; ?> - Température</p>
            <p><?php echo $values[0]['temperature_message']; ?> °C</p>
        </div>

        <div id="humidity">
            <p><?php echo $values[0]['nom_salle']; ?> - Humidité</p>
            <p><?php echo $values[0]['humidite_message']; ?> %</p>
        </div>
    </div>

    <div id="historic">
        <h1>Historique des mesures</h1>

        <table>
            <tr>
                <th>Séquence</th>
                <th>Device</th>
                <th>Température (°C)</th>
                <th>Humidité (%)</th>
                <th>Date</th>
                <th>Salle</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach ($values as $row) : ?>
            <tr>
                <td><?php echo $row['seq_num_message']; ?></td>
                <td><?php echo $row['num_id_capteur']; ?></td>
                <td><?php echo $row['temperature_message']; ?> °C</td>
                <td><?php echo $row['humidite_message']; ?> %</td>
                <td><?php echo $row['date_message']; ?></td>
                <td><?php echo $row['nom_salle']; ?></td>
                <td class="edit"><a href="?act=upd"><img src="../img/editer.png" alt="bouton d'édition" width="40px" height="40px"></a></td>
                <td class="delete"><a href="?act=del"><img src="../img/delete.png" alt="bouton de supression" width="40px" height="40px"></a></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</main>
</body>
</html>
