<?php $titre = SITE_NAME . ' - Créer un compte'; ?>
    
<?php ob_start(); ?>
    
<div class="formulaireCreation">

<!-- Formulaire de création de compte -->
<p>Veuillez créer un identifiant et un mot de passe pour votre compte :</p>

        <form action="index.php?action=createUser" method="post">
        <div class="form-group">
            <p>Identifiant : <input type="text" name="login" placeholder="identifiant" maxlenght="50" required /></p>
            <p>Mail : <input type="text" name="mail" placeholder="email" required maxlenght="50" /></p>
            <p>Mot de passe : <input type="password" name="pass" placeholder="mot de passe" required /></p>
            <p>Retapper le<br>mot de passe : <input type="password" name="pass2" placeholder="mot de passe" required /></p>
            </div>
            <div class="form-check">
            <p><input type="submit" value="Valider" /></p>
            </div>
        </form>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/backTemplate.php'; ?>
