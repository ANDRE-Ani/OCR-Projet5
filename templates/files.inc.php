<div class="p-3 mb-2 bg-info text-white"><h5>Fichiers</h5></div>
<div class="fonct">

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
