<?php

namespace controller;

use Exception;
use DirectoryIterator;
use model\TodoManager;
use model\UserManager;
use model\FrontManager;


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

// list all files
public function listFile() {

    $dir_path = UPLOAD_DIR;
    $filesAll = array();

    foreach (new \DirectoryIterator($dir_path) as $file) {
        if (preg_match('#\.(txt|pdf|jpg|jpeg|png|gif)$#i', $file->getFilename())) {
            $list = array();
            $list['path'] = $file->getPathname();
            $list['name'] = $file->getFilename();
            $list['sizeM'] = $file->getSize();

            // convert to kilo and 2 decimal
            $list['sizeF'] = $list['sizeM'] / 1024;
            $list['sizeF'] = number_format((float)$list['sizeF'], 2, '.', '');

            $list['timeT'] = $file->getMTime();

            //date convertion from timestamp
            $dateA = date('m/d/Y H:i:s', $list['timeT']);
            $list['time'] = $dateA;
            
            array_push($filesAll, $list);
        }
    }
    return $filesAll;
}


public function deleteFile($fichier) {
    
    if (file_exists($fichier)) {
        unlink($fichier);
        header('Location: index.php?action=infos');
      } else {
        echo 'Could not delete '.$fichier.', file does not exist';
      }
}

}
