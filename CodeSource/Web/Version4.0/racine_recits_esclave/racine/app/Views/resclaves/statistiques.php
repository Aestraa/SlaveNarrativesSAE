<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = 'Statistiques'?>
    <title><?= $page_name ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 </head>

<body>
<?php
  use App\Libraries\DatabaseUtils;

  $result = DatabaseUtils::selectVisitByMonth();
  $result2 = DatabaseUtils::selectNameOfPage();
  $result3 = DatabaseUtils::selectNumberOfVisitOfPage();
  ?>

<div class="stats-container">
    <div class="box-stats"><br>Nombre de visite(s) des pages ci-dessous :<br><br><canvas id="myChart"></div>
    <div class="box-stats"><canvas id="myPieChart"></canvas>    </div>
    <div class="box-stats">Box 3</div>
  </div>

  
  <script>
    // Sélectionnez le canvas
      var ctx = document.getElementById('myChart').getContext('2d');

      // Définissez les données du graphique
      var data = {
          labels: <?= json_encode($result2) ?>,
          datasets: [{
              label: 'Visites des pages',
              data: <?= json_encode($result3) ?>,
              backgroundColor: 'rgba(255, 151, 92)', // Couleur de remplissage des barres
              borderColor: 'rgba(0,0,0)', // Couleur des bordures
              borderWidth: 1 // Largeur de la bordure
          }]
      };

      // Définissez les options du graphique
      var options = {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      };

      // Créez le graphique
      var myChart = new Chart(ctx, {
          type: 'bar', // Type de graphique
          data: data,
          options: options
      });


  // Sélectionnez le canvas
      var ctx = document.getElementById('myPieChart').getContext('2d');

      // Définissez les données du graphique (initiallement pour le jour 1)
      var data1 = {
          labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
          datasets: [{
              data: <?= json_encode($result) ?>,
              backgroundColor: ['rgb(182,88,68)', 'rgb(255, 151, 92)'],
              borderColor: ['white'],
              borderWidth: 1
          }]
      };

    // Définissez les options du graphique
    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    // Créez le graphique initial
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data1,
        options: options
    });

      </script>

</body>

</html>