<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />


  <!-- Import de la librairie Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

  <!-- Style Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery (ajax) -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <!-- Leaflet Marker Cluster -->
  <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">

  <!-- Reset View button-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@drustack/leaflet.resetview/dist/L.Control.ResetView.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@drustack/leaflet.resetview/dist/L.Control.ResetView.min.js"></script>

  <script src="https://unpkg.com/Leaflet.Deflate/dist/L.Deflate.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css" media="screen">
  <!-- Leaflet fullscreen-->
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
</head>

<body>
<?php 
 // Démarrer la session
 $session = \Config\Services::session();
 
helper('language');
?>
    <!--Modification de la couleur du fond directement dans le code, non fonctionnel-->
    <style>
      body {
        background-color: #FAEBD7;
      }
    </style>

    <nav class="navbar navbar-expand-lg ">
      <a class="navbar-brand" href="<?= site_url() . "map" ?>"><?php echo lang('headergeo.nav_bar.home')?></a>
      <a class="navbar-brand" href="<?= site_url() . "recits" ?>"><?php echo lang('headergeo.nav_bar.list_narratives')?></a>
      <a href="<?php echo base_url('language/changeLanguage/en'); ?>">English</a>
      <a href="<?php echo base_url('language/changeLanguage/fr'); ?>">French</a>
    </nav>

    <h1 class=tprinc><?php echo lang('headergeo.title')?><?= $session->get('is_admin') ? '(Connecter)' : '' ?> </h1>
    <h3> <?php echo lang('headergeo.subtitle')?> </h3>