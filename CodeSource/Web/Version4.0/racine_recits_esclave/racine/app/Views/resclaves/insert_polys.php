<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_recit.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="login-container">
           <form action="<?= site_url('Ajout/InsertRecit') ?>" method="post">

           <label><?= lang('ajout_recit.name_slave') ?></label>
                    <?php
                    $i = 0;
                    if (!empty($polys) && is_array($polys)) {
                        foreach ($polys as $elt) {
                            foreach($polygones as $te){
                                if($te['id'] == $elt){
                                    echo $te['name'].'<br>';
                                    echo '<select name="type'.$i.'" id="type'.$i.'" required>';
                                    echo '<option value="publication">Publication</option>';
                                    echo '<option value="naissance">Naissance</option>';
                                    echo '<option value="deces">Décès</option>';
                                    echo '<option value="esclavage">Esclavage</option>';
                                    echo '<option value="lieuvie">Lieu de vie</option>';
                                    echo '</select><br><br>';
                                    echo '<input name="idP'.$i.'" id="idP'.$i.'" type="hidden" value="'.$elt.'"/>';
                                    echo '<input name="nomP'.$i.'" id="nomP'.$i.'" type="hidden" value="'.$te['name'].'"/>';
                                    $i++;
                                }
                            }
                            
                            
                        }  
                    }
                    echo '<input name="nb" id="nb" type="hidden" value="'.$i.'"/>';
                    ?>
                     <input name="nomR" id="nomR" type="hidden" value="<?php echo $nomR; ?>" />
                     <input name="idE" id="idE" type="hidden" value="<?php echo $idE; ?>" />
                     <input name="lieuP" id="lieuP" type="hidden" value="<?php echo $lieuP; ?>" />
                     <input name="infoSup" id="infoSup" type="hidden" value="<?php echo $infoSup; ?>" />
                    <input name="dateP" id="dateP" type="hidden" value="<?php echo $dateP; ?>" />
                    <input name="typeR" id="typeR" type="hidden" value="<?php echo $typeR; ?>" />
                    <input name="com" id="com" type="hidden" value="<?php echo $com; ?>" />
                    <input name="modeP" id="modeP" type="hidden" value="<?php echo $modeP; ?>" />
                    <input name="dateN" id="dateN" type="hidden" value="<?php echo $dateN; ?>" />
                    <input name="nomS" id="nomS" type="hidden" value="<?php echo $nomS; ?>" />
                    <input name="lienR" id="lienR" type="hidden" value="<?php echo $lienR; ?>" />
                    <input name="idR" id="idR" type="hidden" value="<?php echo $idR; ?>" />
                    <input name="nomE" id="nomE" type="hidden" value="<?php echo $nomE; ?>" />
        
           <button type="submit"><?= lang('ajout_recit.add_button') ?></button>
        </form>
        
    </div>
</body>
</html>
