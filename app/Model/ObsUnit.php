<?php
App::uses('AppModel', 'Model');
/**
 * ObsUnit Model
 *
 */
class ObsUnit extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'obs_unit';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_obs_unit_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
/*	public $belongsTo = array(
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
		'CdvSource' => array(
			'className' => 'CdvSource',
			'foreignKey' => 'cdv_source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DivObsUnit' => array(
			'className' => 'DivObsUnit',
			'foreignKey' => 'div_obs_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DivStatisticType' => array(
			'className' => 'DivStatisticType',
			'foreignKey' => 'div_statistic_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
}
