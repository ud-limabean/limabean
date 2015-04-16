<?php
App::uses('AppModel', 'Model');
/**
 * StatisticType Model
 *
 */
class StatisticType extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'statistic_type';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'div_statistic_type_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'stat_type';

}
