<?php session_start();

if (isset($_COOKIE['cook']) && !empty($_COOKIE['cook']) && 
    (isset($_SESSION['cook']) && !empty($_SESSION['cook']))) 
{
    $cook = session_id().microtime().rand(0,9999999999);
    $cook = hash('sha512', $cook);
    $_COOKIE['cook'] = $cook;
    $_SESSION['cook'] = $cook;
}
else
{
    $_SESSION = array();
    session_destroy();
    header('Location: index.php?action=connection');
}
?>

<?php $titre = SITE_NAME . ' - Votre portail web personnel'; ?>
    
    <?php ob_start(); ?>
    
<div class=".container-fluid">
  <div class="row">
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">Contacts</div>
  <div class="fonct">Contacts</div>
  </div>
 
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">Bitcoin</div>
  <div class="fonct">Bitcoin</div>
  </div>
  
  <div class="w-100"></div>
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">RSS</div>
  <div class="fonct">Flux RSS</div>
  </div>
  
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">ToDo</div>
  <div class="fonct">
  <p>ToDo List</p>
  
  <form action="index.php?action=createTodo" method="post">
        <div class="form-group">
            <p>Tâche : <input type="text" name="todo" placeholder="tâche à faire" required /></p>
            
            </div>
            <div class="form-check">
            <p><input type="submit" value="Valider" /></p>
            </div>
        </form>
  
  
  </div>
  </div>
  
  <div class="w-100"></div>
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">Carte</div>
  <div class="fonct">Cartographie</div>
  </div>
  
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white">Fichiers</div>
  <div class="fonct">
  <p>Vos fichiers</p>
  
  <form enctype="multipart/form-data" action="?action=upload" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="7340032" />
      Transfère le fichier <input type="file" name="monfichier" />
      <input type="submit" />
    </form>
    
    <?php
    
$iterator = new DirectoryIterator(UPLOAD_DIR);
foreach($iterator as $fichier){

  if(!$fichier->isDot()){
      echo 'Nom : '.$fichier->getFilename(). '<br>';
      echo 'Taille :  '.$fichier->getSize().'<br>';
      echo '<a href="index.php?action=deleteF&amp;fichier='.$fichier.'">Supprimer</a>'.'<br>';
   }
}
    ?>
    </div>
    
  </div>
  
  </div>
  </div>
  
<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/frontTemplate.php'; ?>
