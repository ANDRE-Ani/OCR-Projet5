<?php

namespace controller;

use Exception;
use model\FrontManager;
use model\UserManager;
use model\TodoManager;


// Controler file

class FileController extends Controller
{

public function uploadF() {

    if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
    {
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
               
            header('Location: index.php?action=infos');
            } else {
                echo "Le fichier n'a pas été uploadé (".$fileSize.") ou ".
                        "Le déplacement du fichier temporaire a échoué".
                        " vérifiez l'existence du répertoire ".$repertoireDestination;
            }
        }
    }

    else {
        throw new Exception('Erreur d\'envoie du fichier');
    }

}


public function deleteFile($fileD) {
    
     (unlink('uploads/'.$fileD));

     header('Location: index.php?action=infos');
}







}
