<?php
App::uses('AppModel', 'Model');
/**
 * Measurement Model
 *
 * @property DivField $DivField
 * @property MeasurementParameter $MeasurementParameter
 * @property ObsUnit $ObsUnit
 * @property StatisticType $StatisticType
 */
class Measurement extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'measurement';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_measurement_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'field' => array(
			'className' => 'field',
			'foreignKey' => 'div_field_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MeasurementParameter' => array(
			'className' => 'MeasurementParameter',
			'foreignKey' => 'div_measurement_parameter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ObsUnit' => array(
			'className' => 'ObsUnit',
			'foreignKey' => 'div_obs_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'StatisticType' => array(
			'className' => 'StatisticType',
			'foreignKey' => 'div_statistic_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
