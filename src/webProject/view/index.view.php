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
            </tr>
            <?php foreach ($values as $row) : ?>
            <tr>
                <td><?php echo $row['seq_num_message']; ?></td>
                <td><?php echo $row['num_id_capteur']; ?></td>
                <td><?php echo $row['temperature_message']; ?> °C</td>
                <td><?php echo $row['humidite_message']; ?> %</td>
                <td><?php echo $row['date_message']; ?></td>
                <td><?php echo $row['nom_salle']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</main>
</body>
</html>
