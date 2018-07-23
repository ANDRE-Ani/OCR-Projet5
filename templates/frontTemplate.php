<!DOCTYPE html>
<html lang="fr">
<head>

  <title><?=$titre?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <!-- JS for leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>

   <!-- JS for leaflet -->
   <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
   integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
   crossorigin=""></script>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
    <script src="js/map.js"></script>

</body>
</html>
