<div class="measurements form">
<?php echo $this->Form->create('Measurement'); ?>
	<fieldset>
		<legend><?php echo __('Edit Measurement'); ?></legend>
	<?php
		echo $this->Form->input('div_measurement_id');
		echo $this->Form->input('div_measurement_acc');
		echo $this->Form->input('div_field_id');
		echo $this->Form->input('div_measurement_parameter_id');
		echo $this->Form->input('cdv_source_id');
		echo $this->Form->input('div_obs_unit_id');
		echo $this->Form->input('div_statistic_type_id');
		echo $this->Form->input('tom');
		echo $this->Form->input('value');
		echo $this->Form->input('measurement_comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Measurement.div_measurement_id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Measurement.div_measurement_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Measurements'), array('action' => 'index')); ?></li>
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
