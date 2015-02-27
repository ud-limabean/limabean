<div class="fieldOwnerships form">
<?php echo $this->Form->create('FieldOwnership'); ?>
	<fieldset>
		<legend><?php echo __('Edit Field Ownership'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('div_field_id');
		echo $this->Form->input('div_users_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FieldOwnership.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('FieldOwnership.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Field Ownerships'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
