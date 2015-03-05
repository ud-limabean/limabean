<?php
App::uses('AppModel', 'Model');
/**
 * MeasurementParameter Model
 *
 * @property DivUnitOfMeasure $DivUnitOfMeasure
 */
class MeasurementParameter extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'measurement_parameter';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_measurement_parameter_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'parameter';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UnitOfMeasure' => array(
			'className' => 'UnitOfMeasure',
			'foreignKey' => 'div_unit_of_measure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
