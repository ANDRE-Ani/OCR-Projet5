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
      <td><a href="../index.php?action=deleteTodo&amp;id=<?php echo $data['id']; ?>">Supprimer</a></td>
 </tr>

      <?php
      }
      $tasks->closeCursor();
      ?>

  </table>


</div>
</div>
