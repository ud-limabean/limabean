<div class="measurements view">
<h2><?php echo __('Measurement'); ?></h2>
	<dl>
		<dt><?php echo __('Div Measurement Id'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['div_measurement_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Div Measurement Acc'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['div_measurement_acc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field'); ?></dt>
		<dd>
			<?php echo $this->Html->link($measurement['Field']['div_locality_id'], array('controller' => 'fields', 'action' => 'view', $measurement['Field']['div_field_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement Parameter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($measurement['MeasurementParameter']['parameter'], array('controller' => 'measurement_parameters', 'action' => 'view', $measurement['MeasurementParameter']['div_measurement_parameter_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cdv Source Id'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['cdv_source_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Obs Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($measurement['ObsUnit']['div_obs_unit_id'], array('controller' => 'obs_units', 'action' => 'view', $measurement['ObsUnit']['div_obs_unit_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Statistic Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($measurement['StatisticType']['stat_type'], array('controller' => 'statistic_types', 'action' => 'view', $measurement['StatisticType']['div_statistic_type_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tom'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['tom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measurement Comments'); ?></dt>
		<dd>
			<?php echo h($measurement['Measurement']['measurement_comments']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Measurement'), array('action' => 'edit', $measurement['Measurement']['div_measurement_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Measurement'), array('action' => 'delete', $measurement['Measurement']['div_measurement_id']), array(), __('Are you sure you want to delete # %s?', $measurement['Measurement']['div_measurement_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Measurements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measurement'), array('action' => 'add')); ?> </li>
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
