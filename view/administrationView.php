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

<?php $titre = SITE_NAME . ' - Administration'; ?>




        <p><h4>Serveur</h4></p>
<p>Système d'exploitation : <?php echo php_uname(s); ?></p>
<p>Nom d'hôte : <?php echo php_uname(n); ?></p>
<p>Architecture : <?php echo php_uname(m); ?></p>
<p>Version de PHP : <?php echo phpversion(); ?></p>
<p>Mail de l'administrateur : <?php echo $_SERVER['SERVER_ADMIN'] ?></p>
<p>I.P. du serveur : <?php echo $_SERVER['SERVER_ADDR'] ?></p>
<p>Domaine : <?php echo $_SERVER['HTTP_HOST'] ?></p>

<p><h4>Navigateur client</h4></p>
    <div id="browser">
    </div>

    </div>
    
   </div>
   </div>
   
<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/backTemplate.php'; ?>
