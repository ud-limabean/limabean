<div class="fields form">
<?php echo $this->Form->create('Field'); ?>
	<fieldset>
		<legend><?php echo __('Edit Field'); ?></legend>
	<?php
		echo $this->Form->input('div_field_id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Field.div_field_id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Field.div_field_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fields'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Field Ownerships'), array('controller' => 'field_ownerships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field Ownership'), array('controller' => 'field_ownerships', 'action' => 'add')); ?> </li>
	</ul>
</div>
