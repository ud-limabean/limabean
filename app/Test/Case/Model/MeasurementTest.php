<?php
App::uses('Measurement', 'Model');

/**
 * Measurement Test Case
 *
 */
class MeasurementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.measurement',
		'app.div_field',
		'app.div_measurement_parameter',
		'app.cdv_source',
		'app.div_obs_unit',
		'app.div_statistic_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Measurement = ClassRegistry::init('Measurement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Measurement);

		parent::tearDown();
	}

}
