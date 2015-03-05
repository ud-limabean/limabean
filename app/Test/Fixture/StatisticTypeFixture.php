<?php
/**
 * StatisticTypeFixture
 *
 */
class StatisticTypeFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'statistic_type';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'div_statistic_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'div_statistic_type_acc' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'stat_type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'div_statistic_type_id', 'unique' => 1),
			'div_statistic_type_acc' => array('column' => 'div_statistic_type_acc', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'div_statistic_type_id' => 1,
			'div_statistic_type_acc' => 'Lorem ipsum dolor sit amet',
			'stat_type' => 'Lorem ipsum dolor sit amet'
		),
	);

}
