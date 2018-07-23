
<?php include 'config.php'; ?>

<?php $titre = SITE_NAME . ' - Mentions légales'; ?>

    <?php ob_start(); ?>


<div class=".container-fluid">
  <div class="row">

  <div class="about">

<h2>A propos de 5Project</h2>
<br>
<h3>Usage</h3>
<p><strong>5Project</strong> est un portail web personnel permettant à un utilisateur d'accéder à diverses informations.
Il utilise majoritairement des services libres et permet donc à l'utilisateur un contrôle total de ses données personnelles.</p>
<br>
<h3>Technique</h3>
<p>Techniquement, il est construit en HTML, CSS, JS, PHP et utilise le framework CSS Bootstrap. Il nécessite une base de données MySQL.
La météo est récupérée depuis Openweathermap et la carte grâce à Leaflet.
</p>

  </div>

  </div>
  </div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/frontTemplate.php'; ?>