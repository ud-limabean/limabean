<div class="fields form">
<?php echo $this->Form->create('Field'); ?>
	<fieldset>
		<legend><?php echo __('Add Field'); ?></legend>
	<?php
		echo $this->Form->input('div_field_acc');
		echo $this->Form->input('div_locality_id');
		echo $this->Form->input('field_name');
		echo $this->Form->input('field_number');
		echo $this->Form->input('altitude');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
		echo $this->Form->input('field_comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fields'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measurements'), array('controller' => 'measurements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measurement'), array('controller' => 'measurements', 'action' => 'add')); ?> </li>
	</ul>
</div>
