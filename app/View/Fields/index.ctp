<div class="fields index">
	<h2><?php echo __('Fields'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('div_field_acc'); ?></th>
			<th><?php echo $this->Paginator->sort('div_locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('field_name'); ?></th>
			<th><?php echo $this->Paginator->sort('field_number'); ?></th>
			<th><?php echo $this->Paginator->sort('altitude'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('longitude'); ?></th>
			<th><?php echo $this->Paginator->sort('field_comments'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($fields as $field): ?>
	<tr>
		<td><?php echo h($field['Field']['id']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['div_field_acc']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['div_locality_id']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['field_name']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['field_number']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['altitude']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['longitude']); ?>&nbsp;</td>
		<td><?php echo h($field['Field']['field_comments']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $field['Field']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $field['Field']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $field['Field']['id']), array(), __('Are you sure you want to delete # %s?', $field['Field']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Field'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Field Ownerships'), array('controller' => 'field_ownerships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field Ownership'), array('controller' => 'field_ownerships', 'action' => 'add')); ?> </li>
	</ul>
</div>
