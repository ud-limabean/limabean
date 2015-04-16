<?php
/**
 * MeasurementParameterFixture
 *
 */
class MeasurementParameterFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'measurement_parameter';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'div_measurement_parameter_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'div_measurement_parameter_acc' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'div_unit_of_measure_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'to_accession' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'parameter' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'protocol' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perameter_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'format' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'defaultValue' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'maxValue' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'minValue' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'categories' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'isVisible' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'div_measurement_parameter_id', 'unique' => 1),
			'div_measurement_parameter_acc' => array('column' => 'div_measurement_parameter_acc', 'unique' => 1),
			'FK_div_measurement_parameter_div_unit_of_measure' => array('column' => 'div_unit_of_measure_id', 'unique' => 0)
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
			'div_measurement_parameter_id' => 1,
			'div_measurement_parameter_acc' => 'Lorem ipsum dolor sit amet',
			'div_unit_of_measure_id' => 1,
			'to_accession' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'parameter' => 'Lorem ipsum dolor sit amet',
			'protocol' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'perameter_code' => 'Lorem ipsum dolor sit amet',
			'format' => 'Lorem ipsum dolor sit amet',
			'defaultValue' => 'Lorem ipsum dolor sit amet',
			'maxValue' => 'Lorem ipsum dolor sit amet',
			'minValue' => 'Lorem ipsum dolor sit amet',
			'categories' => 'Lorem ipsum dolor sit amet',
			'isVisible' => 'Lorem ipsum dolor sit amet'
		),
	);

}
