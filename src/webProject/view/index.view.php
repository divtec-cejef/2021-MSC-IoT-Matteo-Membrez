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

    <h1>Atelier IoT / Membrez Matteo</h1>

    <div id="map">
        <img class="map" src="../img/map.png" alt="The map" usemap="#plan">

        <map name="plan">
            <area target="" alt="B1-15" title="B1-15" href="?salle=B1-15" coords="25,228,181,388" shape="rect">
            <area target="" alt="Bureau-PJU" title="Bureau-PJU" href="?salle=Bureau-PJU" coords="24,17,184,148" shape="rect">
            <area target="" alt="B1-13" title="B1-13" href="?salle=B1-13" coords="205,231,340,387" shape="rect">
            <area target="" alt="B1-21" title="B1-21" href="?salle=B1-21" coords="160,483,221,598" shape="rect">
            <area target="" alt="B1-08" title="B1-08" href="?salle=B1-08" coords="480,226,596,387" shape="rect">
            <area target="" alt="B1-05" title="B1-05" href="?salle=B1-05" coords="603,227,800,385" shape="rect">
            <area target="" alt="B1-04" title="B1-04" href="?salle=B1-04" coords="807,227,806,383,968,385,970,309,924,309,922,226" shape="poly">
            <area target="" alt="Bocal" title="Bocal" href="?salle=Bocal" coords="931,228,1004,304" shape="rect">
            <area target="" alt="B1-02" title="B1-02" href="?salle=B1-02" coords="1008,228,1125,228,1126,387,970,384,972,310,1007,307" shape="poly">
            <area target="" alt="B1-01" title="B1-01" href="?salle=B1-01" coords="1131,227,1258,478" shape="rect">
            <area target="" alt="Couloir" title="Couloir" href="?salle=Couloir" coords="24,392,1128,478" shape="rect">
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
                <td class="delete"><a href="?act=del&id=<?=$row['seq_num_message']?>"><img src="../img/delete.png" alt="bouton de supression" width="40px" height="40px"></a></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</main>
</body>
</html>
