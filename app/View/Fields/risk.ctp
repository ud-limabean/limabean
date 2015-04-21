<!-- Begin column 1, map -->
<?php $this->start('col1'); ?>
<div id="map-container">
<?php
echo $this->element('map', array(
                "data" => $field
        ));
?>
</div>
<?php $this->end(); ?>

<!-- Begin column 2, field info -->
<?php
$this->assign('title', $field['Locality']['locality_name']);
$this->assign('subtitle', $field['Locality']['locality_name']);
//$this->start('col2'); ?>
<span><h3>Modified Hyre Susceptibility Rating: </h3><?php echo $index; ?></span>
<span><h3>Modified Raniere Susceptibility Rating: </h3><?php echo $index2; ?></span>

<?php //debug($measurements); ?>

<?php //$this->end(); ?>
