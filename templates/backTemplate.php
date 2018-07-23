<!DOCTYPE html>
<html lang="fr">
<head>

  <title><?=$titre?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<main role="main" class="container-fluid">

<?php include 'includes/header.includes.php';?>

</div>
</div>
</div>

  <div class=".container-fluid">
  <div class="row">
    <div class="col-3">
      <div class="p-3 mb-2 bg-info text-white"><h2>Administration</h2></div>
        <p><h4>Utilisateurs</h4></p>
        <p><?php
if (isset($_SESSION['login'])) {
  echo 'Utilisateur : ' . $_SESSION['login'];
}?></p>
    <p><a href="index.php?action=logout">Se déconnecter</a></p>
    <p><a href="index.php?action=gestionU">Gérer les utilisateurs</a></p>
    <p><a href="index.php?action=creationUser">Créer un utilisateur</a></p>
    </div>

    <div class="col-9">
      <div class="p-3 mb-2 bg-info text-white"><h2>Informations</h2></div>

      <?=$contenu?>
  
  </div>
  </div>
  
  <?php include 'includes/footer.includes.php';?>
    
    </main>

    <!--  JS script -->
    <script src="js/date.js"></script>
    <script src="js/browser.js"></script>
    <script src="js/weather.js"></script>
    
</body>
</html>
