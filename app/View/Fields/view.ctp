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
$this->start('col2'); ?>
	<p><?php echo 'Field #' . $field['Field']['div_field_id'] . ' is located at (' . $field['Field']['latitude'] . 'N,' . $field['Field']['longitude'] . 'W) ' .  $field['Field']['altitude'] . 'FT above sea level';?></p>
	<span id="MeasurementParameters" class="form">
	<?php echo $this->Form->create('Fields'); ?>
	<fieldset>
			<legend><?php echo __('Select measurement variable'); ?></legend>
			<?php
			echo $this->Form->input('parameters',  array('options' => $parameters, 'default' => $div_measurement_parameter_id));
			?>
			<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
	</span>
	<span id="chart-container">
	 <?php

	echo $this->element('chart', array(
			"data" => $measurementAvg
	));

	?>
    </span>
<?php $this->end(); ?>

<!-- Begin bottom section, related data -->
<?php $this->start('data'); ?>
<div class="related">
        <h3><?php echo __('Related Measurements'); ?></h3>
        <?php if (!empty($measurements)): ?>
        <div class="paging">
        <?php
                $this->Paginator->options(array(
                        'url' => array(
                                $field['Field']['div_field_id'],
                                $div_measurement_parameter_id
                        )
                ));

                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                echo '<span>';
		echo $this->Html->link(
                        'Export as CSV',
                        array('controller' => 'fields', 'action' => 'view', $field['Field']['div_field_id'], $div_measurement_parameter_id, 'csv')
						  );
		echo '</span>';
        ?>
        </div>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
                <th><?php echo __('Div Measurement Id'); ?></th>
                <th><?php echo __('Div Measurement Acc'); ?></th>
                <!-- <th><?php #echo __('Div Field Id'); ?></th> -->
                <th><?php echo __('Div Measurement Parameter Id'); ?></th>
                <th><?php echo __('Cdv Source Id'); ?></th>
                <th><?php echo __('Div Obs Unit Id'); ?></th>
                <th><?php echo __('Div Statistic Type Id'); ?></th>
                <th><?php echo __('Tom'); ?></th>
                <th><?php echo __('Value'); ?></th>
                <th><?php echo __('Measurement Comments'); ?></th>
        </tr>
        <?php foreach ($measurements as $measurement):
                $parameter = $measurement['MeasurementParameter']['parameter'];
                $measurement = $measurement['Measurement']; ?>
                <tr>
                        <td><?php echo $measurement['div_measurement_id']; ?></td>
                        <td><?php echo $measurement['div_measurement_acc']; ?></td>
                    <!--    <td><?php #echo $measurement['div_field_id']; ?></td> -->
                    <!--    <td><?php #echo $measurement['div_measurement_parameter_id']; ?></td> -->
                    <!--    <td><?php #echo debug($measurement); ?></td> -->
                        <td><?php echo $parameter; ?></td>
                        <td><?php echo $measurement['cdv_source_id']; ?></td>
                        <td><?php echo $measurement['div_obs_unit_id']; ?></td>
                        <td><?php echo $measurement['div_statistic_type_id']; ?></td>
                        <td><?php echo $measurement['tom']; ?></td>
                        <td><?php echo $measurement['value']; ?></td>
                        <td><?php echo $measurement['measurement_comments']; ?></td>
        <?php endforeach; ?>
        </table>
        </div>

<?php endif; ?>

</div>
<?php $this->end(); ?>
