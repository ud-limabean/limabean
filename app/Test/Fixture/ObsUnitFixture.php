<?php
/**
 * ObsUnitFixture
 *
 */
class ObsUnitFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'obs_unit';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'div_obs_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'div_obs_unit_acc' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'div_field_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'div_stock_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'div_mate_connect_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'coord_x' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'coord_y' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'coord_z' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'plot' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'row' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'plant' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tagname' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'purpose' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'planting_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'harvest_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'delay' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'obs_unit_comments' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'div_obs_unit_id', 'unique' => 1),
			'div_obs_unit_acc' => array('column' => 'div_obs_unit_acc', 'unique' => 1),
			'FK_div_obs_unit_div_field' => array('column' => 'div_field_id', 'unique' => 0),
			'FK_div_obs_unit_div_stock' => array('column' => 'div_stock_id', 'unique' => 0),
			'FK_div_obs_unit_div_mate_connect' => array('column' => 'div_mate_connect_id', 'unique' => 0)
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
			'div_obs_unit_id' => 1,
			'div_obs_unit_acc' => 'Lorem ipsum dolor sit amet',
			'div_field_id' => 1,
			'div_stock_id' => 1,
			'div_mate_connect_id' => 1,
			'coord_x' => 1,
			'coord_y' => 1,
			'coord_z' => 1,
			'plot' => 1,
			'row' => 1,
			'plant' => 'Lorem ipsum dolor sit amet',
			'tagname' => 'Lorem ipsum dolor sit amet',
			'purpose' => 'Lorem ipsum dolor sit amet',
			'planting_date' => '2015-03-05 11:34:13',
			'harvest_date' => '2015-03-05 11:34:13',
			'delay' => 1,
			'obs_unit_comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
