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
  <div class="p-3 mb-2 bg-info text-white"><h5>Météo</h5></div>
  <div class="fonct">

<?php
// get weatherAPI from openweathermap
$url = "https://api.openweathermap.org/data/2.5/weather?q=Paris&units=metric&lang=fr&APPID=8af0f894920fd7fcf2e0dc3b48605453";

$contents = file_get_contents($url);
$clima=json_decode($contents);

$temp_temp = $clima->main->temp;
$temp_hum = $clima->main->humidity;
$temp_press=$clima->main->pressure;
$temp_wind=$clima->wind->speed;
$temp_desc=$clima->weather[0]->description;
$icon=$clima->weather[0]->icon.".png";

$cityname = $clima->name; 

echo $cityname . "<br>";
echo "Humidité : " . $temp_hum . "%" . "<br>";
echo "Température : " . $temp_temp . "°C" . "<br>";
echo "Pression : " . $temp_press . "°" ."<br>";
echo "Vent : " . $temp_wind . "<br>";
echo "Description : " . $temp_desc . "<br>";
echo "<img src='http://openweathermap.org/img/w/" . $icon ."'/ >";
?>

  </div>
  </div>
 
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white"><h5>Bitcoin</h5></div>
  <div class="fonct">Bitcoin</div>

  <?php
// get info API from bitcoin
$api = "https://blockchain.info/ticker";
$json = file_get_contents($api);
$data = json_decode($json, TRUE);
$rateE = $data["EUR"]["last"];
echo "Euro : " . $rateE . "<br>";
?>


  </div>
  
  <div class="w-100"></div>
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white"><h5>RSS</h5></div>
  <div class="fonct">Flux RSS</div>

  </div>
  
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white"><h5>ToDo List</h5></div>
  <div class="fonct">
  
  <form action="index.php?action=createTodo" method="post">
        <div class="form-group">
            <p>Tâche : <input type="text" name="todo" placeholder="tâche à faire" required /></p>
            
            </div>
            <div class="form-check">
            <p><input type="submit" value="Valider" /></p>
            </div>
        </form>
  


<table>
      <tr>
        <th>ID</th>
        <th>Tâche</th>
        <th>Date</th>
        <th>Editer</th>
        <th>Supprimer</th>
</tr>

<tr>
        <?php
         while ($data = $tasks->fetch()) {
            ?>

        <?php list($date, $time) = explode(" ", $data['datetodo']); ?>
        <?php list($year, $month, $day) = explode("-", $date); ?>
        <?php list($hour, $min, $sec) = explode(":", $time); ?>


        <td><?php echo nl2br(htmlspecialchars($data['id'])); ?></td>
        <td><?php echo htmlspecialchars($data['todo']); ?></td>
        <td><?php echo $data['datetodo'] = "$day/$month/$year" . " - " . "$time"; ?></td>
        <td><a href="../index.php?action=viewEditTask&amp;id=<?php echo $data['id']; ?>">Editer</a></td>
        <td><a href="../index.php?action=deletePost&amp;id=<?php echo $data['id']; ?>">Supprimer</a></td>
   </tr>     

        <?php
        }
        $tasks->closeCursor();
        ?>

    </table>

  
  </div>
  </div>
  
  <div class="w-100"></div>
  <div class="col">
  <div class="p-3 mb-2 bg-info text-white"><h5>Carte</h5></div>
  <div class="fonct">Cartographie</div>

<span id="myPosition">
</span>

  <div id="map">
  </div>

  </div>
  
  <div class="col">
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
  
  </div>
  </div>
  
<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/frontTemplate.php'; ?>
