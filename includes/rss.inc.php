<div class="p-3 mb-2 bg-info text-white"><h5>Flux RSS : <?php echo SITE_RSS ?></h5></div>
<div class="fonct">


<div><a href="<?php echo $feed_item->link; ?>"><?php echo $feed_item->title; ?></a></div>
<div>Date de publication : <?php echo $date; ?></div>
<div><?php echo implode(' ', array_slice(explode(' ', $feed_item->description), 0, 14)) . "..."; ?></div>

<?php
$i++;
?>

</div>
</div>
