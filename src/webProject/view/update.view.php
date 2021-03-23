<?php ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/update.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Atelier IoT</title>
</head>
<body>
<main>

    <div class="mesure-box">
        <h1>Mise à jour de la mesure</h1>
        <h2>Numéro de séquence : <?php echo $_GET['id'] ?></h2>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
        <form method="post" action="">
            <div class="mesure">
                <label for="idTempérature">Température : </label>
                <input id="idTempérature" type="number" max="50" min="0" placeholder="<?php echo $_GET['temp']; ?>"  step="0.01" name="z_temperature" value="<?php echo $_GET['temp']; ?>" autofocus="autofocus"/>
            </div>

            <div class="mesure">
                <label for="idHumidité">Humidité : </label>
                <input id="idHumidité" type="number" max="100" min="1" placeholder="<?php echo $_GET['humi']; ?>" required name="z_humidite" value="<?php echo $_GET['humi']; ?>" autofocus="autofocus"/>
            </div>

            <div class="button-maj-box">
            <button type="submit" name="z_bt_maj" class="button-maj">Mettre à jour</button>
            </div>
            <div class="button-cancel-box">
            <button type="reset" name="z_bt_annuler" onclick="location.href = 'index.php';" class="button-cancel">Annuler</button>
            </div>

            <input type="hidden" name="z_frm" value="frm">
        </form>
    </div>

</main>
</body>
</html>
