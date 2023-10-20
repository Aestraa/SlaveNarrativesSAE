<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_point.title') ?>
    <title><?= $page_name ?></title>
    <!-- Ajout du CSS pour la carte Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
    <!-- Ajout du CSS pour la barre de défilement -->
</head>
<body>
    <div class="login-container">
        <h2><?= lang('ajout_poly.title')?></h2>
        <form action="<?= site_url('Ajout/InsertPoly') ?>" method="post">
            <div class="input-group">
                <label for="nom_poly"><?= lang('ajout_poly.poly_name') ?></label>
                <input type="text" id="nom_poly" name="nom_poly" required>
            </div>
            <div class="input-group">
                <div class="scrollable-table"> <!-- Ajout de la classe "scrollable-table" ici -->
                    <table id="exa" class="display" style="width:100%;">
                        <thead>
                            <tr>
                                <th><?= lang('ajout_poly.point') ?></th>
                                <th style="position: relative;"><?= lang('ajout_poly.suppr') ?></th>
                            </tr>
                        </thead>
                        <tbody id="coordonneesTable">
                            <!-- Les coordonnées seront ajoutées ici -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="input-group">
                <label for="type"><?= lang('ajout_point.type') ?></label>
                <select name="type" id="type">
                    <option value="naissance"><?= lang('ajout_point.types.birth') ?></option>
                    <option value="publication"><?= lang('ajout_point.types.publication') ?></option>
                    <option value="deces"><?= lang('ajout_point.types.death') ?></option>
                    <option value="esclavage"><?= lang('ajout_point.types.slavery') ?></option>
                    <option value="lieuvie"><?= lang('ajout_point.types.location_life') ?></option>
                </select>
            </div>
            <!-- Ajoutez un champ de formulaire caché pour les coordonnées -->
            <input type="hidden" name="coordonnees" id="coordonneesInput">

            <button type="submit" id="submit-button"><?= lang('ajout_poly.add_poly_button') ?></button>
        </form>
    </div>

    <!-- Div de la carte -->
    <div id="map" style="width: 100%; height: 500px;"></div>

    <!-- Script pour gérer la carte et ajouter les coordonnées au tableau -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var coordonnees = []; // Tableau pour stocker les coordonnées

        // Fonction pour gérer les clics sur la carte
        function onClick(e) {
            var latlng = e.latlng;
            var lat = latlng.lat;
            var lng = latlng.lng;

            coordonnees.push(latlng);

            // Créez une nouvelle ligne pour le tableau
            var newRow = document.createElement("tr");

            // Créez une cellule pour les coordonnées
            var coordCell = document.createElement("td");
            coordCell.textContent = lat + ", " + lng;

            // Créez une cellule pour le bouton de suppression
            var deleteCell = document.createElement("td");
            var deleteButton = document.createElement("button");
            deleteButton.textContent = "Supprimer";
            deleteButton.onclick = function() {
                // Supprimez la ligne lorsque le bouton est cliqué
                var row = this.parentNode.parentNode;
                // Supprimez également le cercle de la carte
                map.removeLayer(row.circleMarker);
                // Supprimez également la ligne de la polyline
                map.removeLayer(row.polyline);
                coordonnees.splice(coordonnees.indexOf(row.latlng), 1);
                row.parentNode.removeChild(row);
            };

            deleteCell.appendChild(deleteButton);

            var coordonneesInput = document.getElementById('coordonneesInput');
            coordonneesInput.value = JSON.stringify(coordonnees);

            // Ajoutez les cellules à la ligne
            newRow.appendChild(coordCell);
            newRow.appendChild(deleteCell);

            // Ajoutez la ligne au tableau
            document.getElementById("coordonneesTable").appendChild(newRow);

            // Après avoir ajouté un point au tableau
            // Scrollez vers le bas pour afficher le nouveau point ajouté
            var scrollableTable = document.querySelector('.scrollable-table');
            scrollableTable.scrollTop = scrollableTable.scrollHeight;


            // Ajoutez un cercle sur la carte (CircleMarker)
            var circleMarker = L.circleMarker([lat, lng]).addTo(map);
            newRow.circleMarker = circleMarker; // Associez le cercle à la ligne

            // Reliez les points avec une polyline
            if (coordonnees.length > 1) {
                var latlngs = coordonnees.map(function(coord) {
                    return [coord.lat, coord.lng];
                });
                var polyline = L.polyline(latlngs, { color: 'blue' }).addTo(map);
                newRow.polyline = polyline;
            }

            newRow.latlng = latlng; // Associez les coordonnées à la ligne
        }

        map.on('click', onClick);
    </script>
</body>
</html>
        