<!DOCTYPE html>
<html lang="fr">
<head>

  <title><?=$titre?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<body>

<div class="headerinc">
<nav class="navbar navbar-expand-md navbar-dark fixed-top navbar-light" style="background-color: #7594ff;">
      
      <a class="navbar-brand" href="index.php?action=infos">5Project</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?action=infos">Accueil <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=administration">Administration</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=legal">Mentions légales</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?action=about">A propos</a>
          </li>

        </ul>
        
      </div>
    </nav>

    </div>

    
<main role="main" class="container-fluid">

<div class=".container-fluid">
  <div class="row">
      <div class="header">
        <h1>Connexion</h1>
        <p>5Project /\ Votre portail web personnel</p>
      </div>
    </div>
    </div>
  
      <?=$contenu?>
  
  </div>
  </div>
  
  <div class=".container-fluid">
  <div class="row">
    <div class="footer">
      5Project - Copyright - 2018 - Patrice Andreani - <a href="index.php?action=legal">Mentions légales</a> - <a href="index.php?action=about">A propos</a>
      </div>
</div>
</div>
    
    </main>

</body>
</html>
