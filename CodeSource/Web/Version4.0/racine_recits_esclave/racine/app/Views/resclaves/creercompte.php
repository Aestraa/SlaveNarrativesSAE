<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création compte</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <?php
    helper('language')
    ?>
    <div class="login-container">
        <h2><?= lang('creercompte.title')?></h2>
        <form action="<?=  site_url('/Admin/creercompte') ?>" method="post">
            <div class="input-group">
                <label for="username"><?= lang('creercompte.username')?></label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password"><?= lang('creercompte.password')?></label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <a href="/map"><?= lang('creercompte.back_button')?></a> 
            </div><br>
            <button type="submit"><?= lang('creercompte.create_button')?></button>
        </form>
    </div>
</body>

</html>