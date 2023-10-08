<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <h2><?= lang('contact_resc.title') ?></h2>
        <div class="input-group">
            <label for="name"><?= lang('contact_resc.name') ?></label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="email"><?= lang('contact_resc.email') ?></label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="message"><?= lang('contact_resc.message') ?></label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit"><?= lang('contact_resc.send_button') ?></button>
    </div>
</body>

</html>