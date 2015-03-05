<?php

App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'lb_users';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'id';
	public $displayField = 'username';
	public $tablePrefix = '';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
public $hasMany = array(
        'FieldOwnership'  => array(
                'foreignKey' => 'user_id'
        )
    );

public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'A username is required'
            ),
	'The username must be between 5 and 15 characters.'=>array(
	    'rule'=>array('lengthBetween',5,15),
	    'message'=>'The username must be between 5 and 15 characters'      
	    ),
	'That username has alraedy been taken.'=>array(
	    'rule'=>'isUnique',
	    'message'=>'That username has already been taken.'
	    )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'A password is required'
            ),
	    'Match passwords' => array(
		'rule' => 'matchPassword',	    
		'message' => 'Your passwords do not match'
	    )
        ),
	'password_confirmation' => array(
	    'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Please confirm your password.'
            )
	)
        /*'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
         )*/
    );


public function matchPassword($data){
	if ($data['password'] == $this->data['User']['password_confirmation']){
		return true;
	}
	$this->invalidate('password_confirmation','Your passwords do not match.');
	return false;
}

public function beforeSave(){
	if (isset($this->data['User']['password'])){
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	}
	return true;
}
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
