<?php
/**
 * MeasurementFixture
 *
 */
class MeasurementFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'measurement';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'div_measurement_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'div_measurement_acc' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'div_field_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'div_measurement_parameter_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'cdv_source_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'div_obs_unit_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'div_statistic_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'tom' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'value' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'measurement_comments' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'div_measurement_id', 'unique' => 1),
			'div_measurement_acc_UNIQUE' => array('column' => 'div_measurement_acc', 'unique' => 1),
			'FK_div_measurement_div_field' => array('column' => 'div_field_id', 'unique' => 0),
			'FK_div_measurement_div_measurement_parameter' => array('column' => 'div_measurement_parameter_id', 'unique' => 0),
			'FK_div_measurement_cdv_source' => array('column' => 'cdv_source_id', 'unique' => 0),
			'FK_div_measurement_div_obs_unit' => array('column' => 'div_obs_unit_id', 'unique' => 0),
			'FK_div_measurement_div_statistic_type' => array('column' => 'div_statistic_type_id', 'unique' => 0)
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
			'div_measurement_id' => 1,
			'div_measurement_acc' => 'Lorem ipsum dolor sit amet',
			'div_field_id' => 1,
			'div_measurement_parameter_id' => 1,
			'cdv_source_id' => 1,
			'div_obs_unit_id' => 1,
			'div_statistic_type_id' => 1,
			'tom' => '2015-03-05 11:15:15',
			'value' => 'Lorem ipsum dolor sit amet',
			'measurement_comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
