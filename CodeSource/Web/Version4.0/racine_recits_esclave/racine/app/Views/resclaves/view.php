
<link rel="stylesheet" type="text/css" href="<?= base_url('css/notification.css') ?>">

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

<div id="notification" class="hidden">
  <div class="notification-text">Recherche en cours</div>
  <div class="notification-spinner"></div>
</div>

<br><br>

<div id="comm">
    <p style="text-align:center;">
        Commentaires / Historiographie: <br><br> 
        <?= html_entity_decode($histo) ?>

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
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<script>
function afficherPopup(choix) {
  var apiKey = "E7a5WJBnmii1HdXPtMVRZcG1";
  var userId = "5400206";
  var Apidata = [];
  var arrayselec = null ; // Variable pour stocker l'élément correspondant
    var found = false; // Variable pour indiquer si l'élément correspondant a été trouvé

    // Afficher une notification "Recherche en cours"
    var notification = document.getElementById("notification");
    notification.style.display = "block";

  // Fonction pour effectuer la recherche parmi les éléments dans la bibliothèque Zotero
  function makeSearchRequest(query, start) {
    var url = `https://api.zotero.org/users/${userId}/items?limit=25&start=${start}`;
    //console.log('requete');

    return new Promise(function (resolve, reject) {
      $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {

            for (var i = 0; i < Apidata.length && !found; i++) {
                var data = Apidata[i];
                for (var y = 0; y < data.length && !found; y++) {
                    var elt = data[y];
                    if (elt['data']['shortTitle'] === choix) {
                        //console.log('---------------------');
                        //console.log(choix);
                        //console.log(elt);
                        //console.log('---------------------');
                        arrayselec = elt;
                        found = true; // Définir la variable "found" sur true pour sortir des boucles
                    }
                }
            }
          Apidata.push(response);
          resolve(response);
        },
        error: function (xhr, status, error) {
          console.error("La requête a échoué avec le code de statut : " + xhr.status);
          resolve(null);
        }
      });
    });
  }

  // Fonction pour vérifier les données et afficher la pop-up
  function checkData() {
    var titre = "";
    var auteur = "";
    var type = "";
    var date = "";
    var lang = "";
    
    if (arrayselec != null) {
      var item = arrayselec;
      titre = item.data.title;
      auteur = item.meta.creatorSummary;
      type = item.data.itemType;
      date = item.data.date;
      lang = item.data.language;
    } else {
      for (var i = 0; i < Apidata.length; i++) {
        var items = Apidata[i];
        for (var j = 0; j < items.length; j++) {
          var item = items[j];
          if (item.data.shortTitle === choix) {
            titre = item.data.title;
            auteur = item.meta.creatorSummary;
            type = item.data.itemType;
            date = item.data.date;
            lang = item.data.language;
            // Vous pouvez choisir ici comment gérer plusieurs éléments correspondants
            // Pour l'exemple, nous affichons le premier élément correspondant
            arrayselec = item;
            break;
          }
        }
      }
    }

    // Vérifier si le titre est vide
    if (titre === "") {
        notification.style.display = "none";
        // Aucune référence trouvée, afficher un message d'erreur
        var popup = window.open('', '', 'width=400,height=200');
        popup.document.write('Référence non trouvée');
    } else {
        notification.style.display = "none";
        // Afficher les détails de la référence
        var contenuPopup = titre + ', ' + type + ' de ' + auteur + ', le ' + date + ' en ' + lang;
        var popup = window.open('', '', 'width=400,height=200');
        popup.document.write(contenuPopup);
    }
  }

  // Fonction récursive pour effectuer des recherches successives
  function recursiveSearch(query, start) {
    makeSearchRequest(query, start)
      .then(function (response) {
        if (arrayselec == null) {
          if (response && response.length > 0) {
            // S'il y a des éléments dans la réponse, continuez la recherche avec le prochain lot de résultats
            start += 25;
            recursiveSearch(query, start);
          } else {
            // S'il n'y a plus de résultats, vérifiez les données et affichez la popup
            //console.log(Apidata); // Afficher les données dans la console
            checkData();
          }
        } else {
          checkData();
        }
      })
      .catch(function (error) {
        console.error("Erreur :", error);
        checkData(); // En cas d'erreur, vérifiez quand même les données
      });
  }

  // Fonction pour afficher une notification
  function afficherNotification(message) {
    // Vérifier si le navigateur prend en charge les notifications
    if ('Notification' in window) {
      // Vérifier l'autorisation de notification
      if (Notification.permission === 'granted') {
        new Notification(message);
      } else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(function (permission) {
          if (permission === 'granted') {
            new Notification(message);
          }
        });
      }
    }
  }


  // Démarrer la recherche récursive
  var start = 0;
  var query = choix; // Utilisez le choix comme critère de recherche
  recursiveSearch(query, start);
}
</script>
