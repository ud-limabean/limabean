<?php
App::uses('AppModel', 'Model');
/**
 * ObsUnit Model
 *
 * @property DivField $DivField
 * @property DivStock $DivStock
 * @property DivMateConnect $DivMateConnect
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

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'div_obs_unit_id';


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
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'div_stock_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MateConnect' => array(
			'className' => 'MateConnect',
			'foreignKey' => 'div_mate_connect_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
