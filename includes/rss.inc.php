<div class="p-3 mb-2 bg-info text-white"><h5>Flux RSS : <?php echo SITE_RSS ?></h5></div>
<div class="fonct">

<p><a href="<?php echo $feed_item->link; ?>"><?php echo $feed_item->title; ?></a></p>
<p>Date de publication : <?php echo $date; ?></p>
<p><?php echo implode(' ', array_slice(explode(' ', $feed_item->description), 0, 14)) . "..."; ?></p>

<?php
$i++;
?>


</div>
</div>
