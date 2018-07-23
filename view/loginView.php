<?php $titre = SITE_NAME . ' - Connexion'; ?>
    
<?php ob_start(); ?>
    
<div class="formulaireLogin">

<!-- Formulaire de connexion à l'administration -->
<p>Veuillez entrer vos identifiants pour vous connecter :</p>

        <form action="index.php?action=logAdminB" method="post">
        <div class="form-group">
            <p>Identifiant : <input type="text" name="login" placeholder="identifiant" required /></p>
            <p>Mot de passe : <input type="password" name="pass" placeholder="mot de passe" required /></p>
            </div>
            <div class="form-check">
            <p><input type="submit" value="Valider" /></p>
            </div>
        </form>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/loginTemplate.php'; ?>
