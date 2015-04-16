<?php
App::uses('AppModel', 'Model');
/**
 * Locality Model
 *
 */
class Locality extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'locality';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_locality_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'locality_name';

}
