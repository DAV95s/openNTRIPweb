<?php
if ($stations) {
    foreach ($stations as $station) {
        ?>
<div data-toggle="modal" data-target="#stationModal" onclick="stationModalUpdate(<?php echo $station['id'] ?>)" class="station">
  <?php if ($station['is_online']) { ?>
  <img class="on" src="assets/icons8/icons8-online-f2.png">
  <?php } else { ?>
    <img class="off" src="assets/icons8/icons8-offline.png">
  <?php } ?>
  <span class="name"><?php echo $station['mountpoint'] ?></span>
  <span class="format"><?php echo $station['format'] ?></span>
</div>
<?php
    }
}
?>