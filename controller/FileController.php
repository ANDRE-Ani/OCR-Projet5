<?php

namespace controller;

use Exception;
use model\ComManager;
use model\FrontManager;
use model\UserManager;

// Controler file

class FileController extends Controller
{

public function uploadF() {

$nomOrigine = $_FILES['monfichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("txt", "pdf", "png", "jpeg", "jpg", "gif");
$fileSize = $_FILES['monfichier']['size'];
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "Le fichier n'a pas l'extension attendue";
} else {    
    
    $repertoireDestination  =  UPLOAD_DIR;
    $nomDestination = $nomOrigine . "-" . date("d-m-Y") . "." . $extensionFichier;

    if (move_uploaded_file($_FILES["monfichier"]["tmp_name"], $repertoireDestination.$nomDestination)) {
        // echo "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"]." a été déplacé vers ".$repertoireDestination.$nomDestination;
        
    header('Location: index.php?action=infos');
    } else {
        echo "Le fichier n'a pas été uploadé (".$fileSize.") ou ".
                "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
    }
}
}


public function deleteFile() {
// if (isset($_GET['fichier']) && $_GET['fichier'] > 0) {
     unlink('fichier');
     header('Location: index.php?action=infos');
     
     // } else { 
     // echo "erreur...";
     // }

}







}
