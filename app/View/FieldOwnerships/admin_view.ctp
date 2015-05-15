<div class="fieldOwnerships view">
<h2><?php echo __('Field Ownership'); ?></h2>
        <dl>
                <dt><?php echo __('Id'); ?></dt>
                <dd>
                        <?php echo h($fieldOwnership['FieldOwnership']['div_field_ownerships_id']); ?>
                        &nbsp;
                </dd>
                <dt><?php echo __('Field'); ?></dt>
                <dd>
                        <?php echo $this->Html->link($fieldOwnership['Field']['div_field_id'], array('controller' => 'fields', 'action' => 'view', $fieldOwnership['Field']['div_field_id'])); ?>
                        &nbsp;
                </dd>
                <dt><?php echo __('Div Users Id'); ?></dt>
                <dd>
                        <?php echo h($fieldOwnership['FieldOwnership']['div_users_id']); ?>
                        &nbsp;
                </dd>
        </dl>
</div>
<div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
                <li><?php echo $this->Html->link(__('Edit Field Ownership'), array('action' => 'edit', $fieldOwnership['FieldOwnership']['div_field_ownerships_id'])); ?> </li>
                <li><?php echo $this->Form->postLink(__('Delete Field Ownership'), array('action' => 'delete', $fieldOwnership['FieldOwnership']['div_field_ownerships_id']), array(), __('Are you sure you want to delete # %s?', $fieldOwnership['FieldOwnership']['div_field_ownerships_id'])); ?> </li>
                <li><?php echo $this->Html->link(__('List Field Ownerships'), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New Field Ownership'), array('action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        </ul>
</div>

