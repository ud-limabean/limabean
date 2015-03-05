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
		<dt><?php echo __('Div Locality Id'); ?></dt>
		<dd>
			<?php echo h($field['Field']['div_locality_id']); ?>
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
		<li><?php echo $this->Html->link(__('List Field Ownerships'), array('controller' => 'field_ownerships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field Ownership'), array('controller' => 'field_ownerships', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Field Ownerships'); ?></h3>
	<?php if (!empty($field['FieldOwnership'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Div Field Id'); ?></th>
		<th><?php echo __('Div Users Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($field['FieldOwnership'] as $fieldOwnership): ?>
		<tr>
			<td><?php echo $fieldOwnership['id']; ?></td>
			<td><?php echo $fieldOwnership['field_id']; ?></td>
			<td><?php echo $fieldOwnership['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'field_ownerships', 'action' => 'view', $fieldOwnership['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'field_ownerships', 'action' => 'edit', $fieldOwnership['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'field_ownerships', 'action' => 'delete', $fieldOwnership['id']), array(), __('Are you sure you want to delete # %s?', $fieldOwnership['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Field Ownership'), array('controller' => 'field_ownerships', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
