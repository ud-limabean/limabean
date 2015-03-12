<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Div Users Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
                <dd>
                        <?php echo h($user['User']['modified']); ?>
                        &nbsp;
                </dd>
		<dt><?php echo __('Role'); ?></dt>
                <dd>
                        <?php echo h($user['User']['role']); ?>
                        &nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Field Ownerships'), array('controller' => 'field_ownerships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field Ownership'), array('controller' => 'field_ownerships', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Field Ownerships'); ?></h3>
	<?php if (!empty($user['FieldOwnership'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Div Field Id'); ?></th>
		<th><?php echo __('Div Users Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['FieldOwnership'] as $fieldOwnership): ?>
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


	<div class='ui'>
	<?php
		echo $this->element('map', array(
                	"data" => $user['FieldOwnership']
        	));
	?>
	</div>
</div>
