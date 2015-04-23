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
$this->assign('title', $this->Html->link($field['Locality']['locality_name'], array('controller' => 'fields', 'action' => 'view', $field['Field']['div_field_id'])
));

$this->assign('subtitle', $this->Html->link($field['Locality']['locality_name'], array('controller' => 'fields', 'action' => 'view', $field['Field']['div_field_id'])
));
//$this->assign('subtitle', $field['Locality']['locality_name']);
$this->start('col2'); 
//if (is_null($risk)){

	echo $this->Form->create('Measurement');
        echo  '<fieldset>
                <legend>Choose parameters for risk calculation</legend>';
		echo $this->Form->input(
                        'cultivar',
                        array(
                                'type'=>'checkbox',
                                'label'=>'Field planted with race F susceptible cultivar – (continue) Cypress, Jackson Wonder, C-Elite',
                              	'checked'=> true,
				'format' => array('before', 'label', 'between', 'input', 'after', 'error')
				//'div'=> true
			//	'hidden'=> false
				//'selected'=>$date
                        )
                        );

		echo $this->Form->input(
                        'history',
                        array(
                                'type'=>'select',
                                'label'=>'Last year with downy mildew',
				'options'=> array(3=>'Last season',2=>'2 seasons ago',1=>'3 seasons ago', 0=> 'More than 3 seasons ago or never'),	
                                'default'=> 1
                        //      'hidden'=> false
                                //'selected'=>$date
                        )
                        );

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
	echo '<span><h5>Risk is rated from 1 (Low) to 10 (High)</h5>';
	echo '<span><h3>Modified Hyre Risk Rating: </h3>' .  $risk['hyre'] . '</span>';
	echo '<span><h3>Modified Raniere Risk Rating: </h3>' . $risk['raniere'] . '</span>';
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
			<td><?php echo __('Rain total, Inches, 10-day'); ?></td>
			<td><?php echo $risk['rain']; ?></td>
	</tr>
	<tr>
                        <td><?php echo __('Accumulated Dew, Hours, 5-day'); ?></td>
                        <td><?php echo $risk['rh']; ?></td>
        </tr>
	<tr>
			<td><?php echo __('A: History of Downy'); ?></td>
			<td><?php echo $risk['a']; ?></td>
	</tr>
	<tr>
                        <td><?php echo __('B: Tempurature'); ?></td>
                        <td><?php echo $risk['b']; ?></td>
        </tr>
	<tr>
                        <td><?php echo __('C: Rain'); ?></td>
                        <td><?php echo $risk['c']; ?></td>
	</tr>
	<tr>
                        <td><?php echo __('D: Dew'); ?></td>
                        <td><?php echo $risk['d']; ?></td>
        </tr>

</table>

<?php endif; ?>
<?php //debug($measurements); ?>

<?php $this->end(); ?>
