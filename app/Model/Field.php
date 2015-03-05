<?php
App::uses('AppModel', 'Model');
/**
 * Field Model
 *
 * @property DivLocality $DivLocality
 * @property Measurement $Measurement
 */
class Field extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'field';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_field_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'div_field_id';

/**
 * Containable; needed to limit results on related models
 *
 * @var array
 */
        public $actsAs = array('Containable');



	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Locality' => array(
			'className' => 'Locality',
			'foreignKey' => 'div_locality_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Measurement' => array(
			'className' => 'Measurement',
			'foreignKey' => 'div_field_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
