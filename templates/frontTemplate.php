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


      <?=$contenu?>
  
  </div>
  </div>
  
<?php include 'includes/footer.includes.php';?>
    
    </main>
    
    <!--  JS script -->
    <script src="js/date.js"></script>
    <script src="js/browser.js"></script>

</body>
</html>
