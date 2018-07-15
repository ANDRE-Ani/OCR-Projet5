<?php $titre = SITE_NAME . ' - Editer une tâche'; ?>
    
<?php ob_start(); ?>
    
<div class="formulaireEditTask">

<form action="index.php?action=editTodo&id=<?php echo $todoE['id'] ?>" method="post">
        <div class="form-group">
            <p>Tâche : <input type="text" name="todo" value="<?php echo $todoE['todo']; ?>" /></p>
            
            </div>
            <div class="form-check">
            <p><input type="submit" value="Valider" /></p>
            </div>
        </form>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'templates/backTemplate.php'; ?>
