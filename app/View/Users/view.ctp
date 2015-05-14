<!-- Begin column 1, map -->
<?php $this->start('col1'); ?>
<div id="map-container">
<h3><?php echo __('Your Farms'); ?></h3>
<?php
echo $this->element('map', array(
                "data" => $user['FieldOwnership']
        ));
?>
</div>
<?php $this->end(); ?>

<!-- Begin column 2, field info -->
<?php
$this->assign('title', $user['User']['username']);
$this->assign('subtitle', $user['User']['username']);
$this->start('col2'); ?>
<span>
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
<?php $this->end(); ?>
