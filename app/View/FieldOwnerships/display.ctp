<div class="fieldOwnerships index">
	<h2><?php echo __('Field Ownerships'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_field_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($fieldOwnerships as $fieldOwnership): ?>
	<tr>
		<td><?php echo h($fieldOwnership['FieldOwnership']['div_field_ownerships_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fieldOwnership['Field']['div_field_id'], array('controller' => 'fields', 'action' => 'view', $fieldOwnership['Field']['div_field_id'])); ?>
		</td>
		<td><?php echo h($fieldOwnership['FieldOwnership']['user_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fieldOwnership['FieldOwnership']['div_field_ownerships_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fieldOwnership['FieldOwnership']['div_field_ownerships_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fieldOwnership['FieldOwnership']['div_field_ownerships_id']), array(), __('Are you sure you want to delete # %s?', $fieldOwnership['FieldOwnership']['div_field_ownerships_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Field Ownership'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
