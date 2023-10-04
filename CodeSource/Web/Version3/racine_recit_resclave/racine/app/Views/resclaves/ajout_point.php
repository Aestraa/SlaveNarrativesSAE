<!DOCTYPE html>
<html lang="fr">

<?php
$model = new \App\Models\ModelGetPoints();
$lastPoint = $model->getLastPoint();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un Point</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <h2>Ajout d'un Point</h2>
        <form action="<?= site_url('Ajout/InsertPoint') ?>" method="post">
            <div class="input-group">
                <label for="coord">Coordonnées</label>
                <input type="text" id="coord" name="coord" required>
            </div>
            <div class="input-group">
                <label for="ville">ville</label>
                <input type="ville" id="ville" name="ville" required>
            </div>
            <div class="input-group">
                <label for="type">Type de point:</label>
                <select name="type" id="type">
                    <option value="naissance">Naissance</option>
                    <option value="publication">Publication</option>
                    <option value="deces">Décée</option>
                    <option value="esclavage">Esclavage</option>
                    <option value="lieuvie">Lieu de Vie</option>
                </select>
            </div>
            <div class="input-group">
                <label for="recit">Joindre a un Récit:</label>
                <select name="recit" id="recit">
                    <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            //$Licoord = explode(',',$elt['titre']);
                            echo '<option value="' . $elt['id_recit'] . '">' . $elt['nom_esc'] . ' (' . $elt['date_publi'] . ')</option>';
                        }
                    }


                    ?>
                </select>
            </div>
            <div class="input-group">
                <label for="point">Id du Recit</label>
                <?php
                echo '<input type="text" id="point" name="point" value="' . $lastPoint . '">';
                ?>
            </div>
            <button type="submit">Terminer</button>
        </form>
    </div>
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d38842409.43735749!2d-32.80326698876798!3d32.535496033354896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1695204067631!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</body>

</html>