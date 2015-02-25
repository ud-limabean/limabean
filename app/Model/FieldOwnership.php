<?php

App::uses('AppModel', 'Model');
/**
 * FieldOwnership Model
 *
 */
class FieldOwnership extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
//	public $useTable = 'fields';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Field' => array(
			'className' => 'Field',
			'foreignKey' => 'div_field_id'
		//	'conditions' => '',
		//	'fields' => 'div_field_id',
		//	'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'div_users_id',
			'conditions' => '',
		));
/*		'CdvSource' => array(
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
	); */
}
