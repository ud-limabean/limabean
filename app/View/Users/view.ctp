<div id="users-view">
<span>
<h2><?php echo __($user['User']['username']); ?></h2>
	<dl>
		<dt><?php echo __('Div Users Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
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
</span>
</div>

<div id="map-container">
<h3><?php echo __('Your Farms'); ?></h3>
<?php
echo $this->element('map', array(
                "data" => $user['FieldOwnership']
        ));
?>
</div>

