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

<?php include 'config.php'; ?>

<?php $titre = SITE_NAME . ' - Votre portail web personnel'; ?>

    <?php ob_start(); ?>


<div class=".container-fluid">
  <div class="row">
  <div class="col">

<!-- weather fonct -->
    <?php include 'includes/weather.inc.php';?>


  <div class="col">

<!-- bitcoin fonct -->
<?php include 'includes/bitcoin.inc.php';?>


  <div class="w-100"></div>
  <div class="col">


    <!-- rss fonct -->
    <?php include 'includes/rss.inc.php';?>


  <div class="col">

    <!-- todo fonct -->
    <?php include 'includes/todo.inc.php';?>


  <div class="w-100"></div>
  <div class="col">

    <!-- map fonct -->
    <?php include 'includes/map.inc.php';?>


  <div class="col">

    <!-- files fonct -->
    <?php include 'includes/files.inc.php';?>


  </div>
  </div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/frontTemplate.php'; ?>
