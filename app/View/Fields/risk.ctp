<?php if(!isset($date)){
	$date=NULL;
	}
?>
<!-- Begin column 1, map -->
<?php $this->start('col1'); ?>
<div id="map-container">
<?php
echo $this->element('map', array(
                "data" => $field
        ));
?>
</div>
<?php $this->end(); ?>

<!-- Begin column 2, field info -->
<?php
$this->assign('title', $field['Locality']['locality_name']);
$this->assign('subtitle', $field['Locality']['locality_name']);
$this->start('col2'); 
//if (is_null($risk)){
	echo $this->Form->create('Measurement');
        echo  '<fieldset>
                <legend>Choose a date for which to show risk</legend>';

		echo $this->Form->input(
			'tom',
			array(
				'type'=>'date',
				'label'=>'Date',
				'dateFormat'=>'YMD',
				'monthNames' => false,
				'minYear'=> 2013,
				'maxYear'=> 2013
				//'selected'=>$date
			)
			);
                //echo $this->Form->input('username');
                //echo $this->Form->input('password');
                //echo $this->Form->input('password_confirmation');
                //echo $this->Form->input('role');
        ?>
        </fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>

<?php if (!is_null($risk)): ?>

	<?php
	echo '<span><h3>Modified Hyre Susceptibility Rating: </h3>' .  $risk['hyre'] . '</span>';
	echo '<span><h3>Modified Raniere Susceptibility Rating: </h3>' . $risk['raniere'] . '</span>';
	?>

<table cellpadding = "0" cellspacing = "0">
	<tr>
			<td><?php echo __('Susceptible Cultivar (1 = yes, 0 = no)'); ?></td>
			<td><?php echo $risk['cultivar']; ?></td>
	</tr>
	<tr>
			<td><?php echo __('History of Downy(3 = last season, 2 = season before last, 1 = 2 seasons or more)'); ?></td>
			<td><?php echo $risk['history']; ?></td>
	</tr>
	<tr>
			<td><?php echo __('Average max daily tempurature, F, 5-day'); ?></td>
			<td><?php echo $risk['tempurature']; ?></td>
	</tr>
	<tr>
			<td><?php echo __('Rain total, Inches, 5-day'); ?></td>
			<td><?php echo $risk['rain']; ?></td>
	</tr>
	<tr>
			<td><?php echo __('Accumulated Dew, Hours, 5-day'); ?></td>
			<td><?php echo $risk['rh']; ?></td>
	</tr>
</table>

<?php endif; ?>
<?php //debug($measurements); ?>

<?php $this->end(); ?>
