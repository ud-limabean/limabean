<div class="measurements index">
	<h2><?php echo __('Measurements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('div_measurement_id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_measurement_acc'); ?></th>
			<th><?php echo $this->Paginator->sort('div_field_id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_measurement_parameter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cdv_source_id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_obs_unit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_statistic_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tom'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('measurement_comments'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($measurements as $measurement): ?>
	<tr>
		<td><?php echo h($measurement['Measurement']['div_measurement_id']); ?>&nbsp;</td>
		<td><?php echo h($measurement['Measurement']['div_measurement_acc']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($measurement['Field']['div_locality_id'], array('controller' => 'fields', 'action' => 'view', $measurement['Field']['div_field_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($measurement['MeasurementParameter']['parameter'], array('controller' => 'measurement_parameters', 'action' => 'view', $measurement['MeasurementParameter']['div_measurement_parameter_id'])); ?>
		</td>
		<td><?php echo h($measurement['Measurement']['cdv_source_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($measurement['ObsUnit']['div_obs_unit_id'], array('controller' => 'obs_units', 'action' => 'view', $measurement['ObsUnit']['div_obs_unit_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($measurement['StatisticType']['stat_type'], array('controller' => 'statistic_types', 'action' => 'view', $measurement['StatisticType']['div_statistic_type_id'])); ?>
		</td>
		<td><?php echo h($measurement['Measurement']['tom']); ?>&nbsp;</td>
		<td><?php echo h($measurement['Measurement']['value']); ?>&nbsp;</td>
		<td><?php echo h($measurement['Measurement']['measurement_comments']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $measurement['Measurement']['div_measurement_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $measurement['Measurement']['div_measurement_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $measurement['Measurement']['div_measurement_id']), array(), __('Are you sure you want to delete # %s?', $measurement['Measurement']['div_measurement_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Measurement'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measurement Parameters'), array('controller' => 'measurement_parameters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measurement Parameter'), array('controller' => 'measurement_parameters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Obs Units'), array('controller' => 'obs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Obs Unit'), array('controller' => 'obs_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statistic Types'), array('controller' => 'statistic_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statistic Type'), array('controller' => 'statistic_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
