<div class="fields view">
<h2><?php echo __('Field'); ?></h2>
	<dl>
		<dt><?php echo __('Div Field Id'); ?></dt>
		<dd>
			<?php echo h($field['Field']['div_field_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Div Field Acc'); ?></dt>
		<dd>
			<?php echo h($field['Field']['div_field_acc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($field['Locality']['locality_name'], array('controller' => 'localities', 'action' => 'view', $field['Locality']['div_locality_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field Name'); ?></dt>
		<dd>
			<?php echo h($field['Field']['field_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field Number'); ?></dt>
		<dd>
			<?php echo h($field['Field']['field_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Altitude'); ?></dt>
		<dd>
			<?php echo h($field['Field']['altitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($field['Field']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($field['Field']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field Comments'); ?></dt>
		<dd>
			<?php echo h($field['Field']['field_comments']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Field'), array('action' => 'edit', $field['Field']['div_field_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Field'), array('action' => 'delete', $field['Field']['div_field_id']), array(), __('Are you sure you want to delete # %s?', $field['Field']['div_field_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measurements'), array('controller' => 'measurements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measurement'), array('controller' => 'measurements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Measurements'); ?></h3>
	<?php if (!empty($measurements)): ?>
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
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>

	<?php foreach ($measurements as $measurement): 
                $parameter = $measurement['MeasurementParameter']['parameter'];
		$measurement = $measurement['Measurement']; ?>
		<tr>
                        <td><?php echo $measurement['div_measurement_id']; ?></td>
                        <td><?php echo $measurement['div_measurement_acc']; ?></td>
                    <!--    <td><?php echo $measurement['div_field_id']; ?></td> -->
                    <!--    <td><?php #echo $measurement['div_measurement_parameter_id']; ?></td> -->
                    <!--    <td><?php #echo debug($measurement); ?></td> -->
			<td><?php echo $parameter; ?></td>
			<td><?php echo $measurement['cdv_source_id']; ?></td>
                        <td><?php echo $measurement['div_obs_unit_id']; ?></td>
                        <td><?php echo $measurement['div_statistic_type_id']; ?></td>
                        <td><?php echo $measurement['tom']; ?></td>
                        <td><?php echo $measurement['value']; ?></td>
                        <td><?php echo $measurement['measurement_comments']; ?></td>
                        <td class="actions">
                                <?php echo $this->Html->link(__('View'), array('controller' => 'measurements', 'action' => 'view', $measurement['div_measurement_id'])); ?>
                                <?php echo $this->Html->link(__('Edit'), array('controller' => 'measurements', 'action' => 'edit', $measurement['div_measurement_id'])); ?>
                                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'measurements', 'action' => 'delete', $measurement['div_measurement_id']), array(), __('Are you sure you want to delete # %s?', $measurement['div_measurement_id'])); ?>
                        </td>
                </tr>
        <?php endforeach; ?>
	</table>
	<div class="paging">
        <?php
                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
	</div>

<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Measurement'), array('controller' => 'measurements', 'action' => 'add')); ?> </li>
		</ul>
	</div>

	<div class='ui'>
	<?php
	// echo $this->element('map', array("data" => $field));
	// echo $this->element('map');

	echo $this->element('map', array(
                "data" => $field
        ));

	
	/*
	echo $this->element('map', array(
    		"lat" => $field['Field']['latitude'],
		"lon" => $field['Field']['longitude']
	));
	*/

	?>
	</div>

</div>
