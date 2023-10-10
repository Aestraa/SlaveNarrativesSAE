<?php
// Remplacez ces valeurs par les vôtres
$userId = "12590816";
$apiKey = "KOxihaGOFAJo7XOhFIqvtGyg";
//Api du client
//$userId = "12590816";
//$apiKey = "E7a5WJBnmii1HdXPtMVRZcG1";
// clé de la collection 'test'
$key = "NPKZ2DS9";

// URL de l'API Zotero
$url = "https://api.zotero.org/users/$userId/collections/$key/items";
//$url = "https://api.zotero.org/users/$userId/collections";

// Configuration de la requête cURL
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer $apiKey"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Exécution de la requête
$response = curl_exec($curl);
$httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// Gestion de la réponse
if ($httpStatus == 200) {
    $data = json_decode($response, true);
    // Traitez les données ici
  
    //var_dump($data);
} else {
    echo "La requête a échoué avec le code de statut : $httpStatus";
}

// Fermeture de la session cURL
curl_close($curl);
?>

<?php 
    $list =[
        'titre' => 'erreur',
        'auteur' => 'erreur',
        'type' => 'erreur',
        'date' => 'erreur',
        'lang' => 'erreur'
    ];

/*
    $titre ='';
    foreach ($data as &$elt){
        if($elt['data']['shortTitle'] == $valeur){
            $list =[
                'titre' => $elt['data']['title'],
                'auteur' => $elt['meta']['creatorSummary'],
                'type' => $elt['data']['itemType'],
                'date' => $elt['data']['date'],
                'lang' => $elt['data']['language']
            ];
            break;
        }
    }
    */
?>



<br><br>
<div class="container">
<p style="text-align:center; font-size:25px;padding:6px;">  
    <?= lang('view.title') ?></p>

    <div class="rec"><br>
    <p style="text-align:center; font-size:25px; font-style:italic;padding:6px;">

    <?= esc($rec['titre']) ?> </p><br>
</div>
    <br> 
    <div class="rec"><br>
    
        <div class="rec_par">
        <strong><p style="text-align:right;"><?= lang('view.year_publication') ?> :</strong> <?= esc($rec['date_publi']) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.method_publication') ?> :</strong> <?= esc($rec['mode_publi']) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.several_written_narratives') ?> :</strong> <?= esc($rec['plrs_recits']) ?> </p>

    <strong><p><?= lang('view.name_slave') ?> :</strong> <?= esc($rec['nom_esc']) ?> </p>
    <strong><p><?= lang('view.type_narrative') ?> :</strong> <?= esc($rec['type_recit']) ?> </p>

    <strong><p><?= lang('view.date_birth') ?> :</strong> <?= esc($rec['naissance']) ?> </p>
    <strong><p><?= lang('view.location_publication') ?> :</strong> <?= esc($rec['lieu_publi']) ?> </p>
    <strong><p><?= lang('view.origins_parents') ?> :</strong> <?= esc($rec['origine_parents']) ?> </p>
    <strong><p><?= lang('view.name_writer') ?> :</strong> <?= esc($rec['scribe_editeur']) ?> </p>
    <strong><p><?= lang('view.additional_information') ?> :</strong> <?= esc($rec['particularites']) ?> </p>

</div>
<br><br>

<div id="comm">
    <p style="text-align:center;">
    <?= lang('view.comments') ?> : <br><br> 
        <?= html_entity_decode($rec['historiographie']) ?>

</p>
</div>

<br>
<p><?= lang('view.link_narrative') ?> : <a href="<?= esc($rec['lien_recit']) ?>"><?= esc($rec['lien_recit']) ?></a></p>


<br><br>
<div style="display:flex;">
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."recits" ?>"'><p><?= lang('view.back_narratives_list_button') ?></p></button>
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."map" ?>"'><p><?= lang('view.back_narratives_map_button') ?></p></button>
<br><br>
</div>
<br>
    </div>
</div>
    <script>
        function afficherPopup(choix) {
            // Recherchez l'élément correspondant à la valeur de choix dans le tableau data
            var data = <?php echo json_encode($data); ?>;

            var elt = null;
            for (var i = 0; i < data.length; i++) {
                if (data[i].data.shortTitle === choix) {
                    elt = data[i];
                    break;
                }
            }

            // Si un élément correspondant est trouvé, utilisez ses données pour afficher le contenu de la pop-up
            if (elt) {
                var titre = elt.data.title;
                var auteur = elt.meta.creatorSummary;
                var type = elt.data.itemType;
                var date = elt.data.date;
                var lang = elt.data.language;

                // Générez le contenu de la pop-up avec les informations
                var contenuPopup = titre + ', ' + type + ' de ' + auteur + ', le ' + date + ' en ' + lang;

                // Ouvrez une nouvelle fenêtre pop-up avec le contenu généré
                var popup = window.open('', '', 'width=400,height=200');
                popup.document.write(contenuPopup);
            } else {
                // Si aucun élément correspondant n'est trouvé, affichez un message d'erreur ou gérez-le selon vos besoins.
                alert('Aucun élément correspondant trouvé pour le choix ' + choix);
            }
        }
</script>

