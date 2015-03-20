<?php
App::uses('AppModel', 'Model');
/**
 * MeasurementAvg Model
 *
 * @property DivField $DivField
 */
class MeasurementAvg extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'lb_measurement_avg';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Field' => array(
			'className' => 'Field',
			'foreignKey' => 'div_field_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
