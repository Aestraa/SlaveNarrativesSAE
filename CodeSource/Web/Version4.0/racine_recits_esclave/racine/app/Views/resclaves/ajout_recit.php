<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_recit.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
<a class="retour" href="<?= site_url('/map') ?>"><?= lang('recits.bouton_retour') ?></a></p>
    <div class="login-container">
           <form action="<?= site_url('Ajout/InsertPoly_Recit') ?>" method="post">
           <label><?= lang('ajout_recit.name_narrative') ?></label>
           <input name="nomR" id="nomR" type="text" /><br><br>
        
           <label><?= lang('ajout_recit.name_slave') ?></label>
           <select name="idE" id="idE" required>
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>

           <label><?= lang('ajout_recit.location_publication') ?></label>
           <input name="lieuP" id="lieuP" type="text" required/><br><br>

           <!--<label>Information supplémentaire :</label>
           <input name="infoSup" id="infoSup" type="text" /><br><br>-->

           <label><?= lang('ajout_recit.year_publication') ?></label>
           <input name="dateP" id="dateP" type="date" required/><br><br>
        
           <label><?= lang('ajout_recit.type_narrative') ?></label>
           <input name="typeR" id="typeR" type="text" required/><br><br>
        
           <label><?= lang('ajout_recit.comments') ?></label>
           <input name="com" id="com" type="text" required/><br><br>

           <label><?= lang('ajout_recit.method_publication') ?></label>
           <input name="modeP" id="modeP" type="text" required/><br><br>
        
          <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

           <label><?= lang('ajout_recit.name_writer') ?></label>
           <input name="nomS" id="nomS" type="text" required/><br><br>
        
           <label><?= lang('ajout_recit.link_narrative') ?></label>
           <input name="lienR" id="lienR" type="text" /><br><br>

           <label><?= lang('ajout_recit.choix_polys') ?></label>
           <select name="poly[]" id="poly" multiple required>
                    <?php
                    if (!empty($polys) && is_array($polys)) {
                        foreach ($polys as $elt) {
                            echo '<option value="' . $elt['id'] . '">' . $elt['name']. ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>
        
           <button type="submit"><?= lang('ajout_recit.add_button') ?></button>
        </form>
        
    </div>
    <script>
        var select = document.getElementById('poly');
        var scrollPosition = 0;

        window.onmousedown = function(e) {
            // Enregistrez la position de défilement actuelle

            var el = e.target;
            if (el.tagName.toLowerCase() === 'option' && el.parentNode.hasAttribute('multiple')) {
                e.preventDefault();

                // Toggle selection
                if (el.hasAttribute('selected')) el.removeAttribute('selected');
                else el.setAttribute('selected', '');

                // Hack to correct buggy behavior
                var clonedSelect = select.cloneNode(true);
                select.parentNode.replaceChild(clonedSelect, select);

                // Restaurez la position de défilement après le changement de sélection
                clonedSelect.scrollTop = scrollPosition;
            }
        };
    </script>
</body>
</html>
