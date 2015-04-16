<?php
/**
 * LbMeasurementAvgFixture
 *
 */
class LbMeasurementAvgFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'lb_measurement_avg';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'div_field_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true, 'key' => 'index'),
		'div_measurement_parameter_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true, 'key' => 'index'),
		'average' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '6,2', 'unsigned' => false),
		'month' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_div_measurement_avg_div_field' => array('column' => 'div_field_id', 'unique' => 0),
			'FK_div_measurement_avg_div_measurement_parameter' => array('column' => 'div_measurement_parameter_id', 'unique' => 0)
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
			'id' => 1,
			'div_field_id' => 1,
			'div_measurement_parameter_id' => 1,
			'average' => '',
			'month' => 1,
			'year' => 1
		),
	);

}
