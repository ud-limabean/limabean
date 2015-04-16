<?php
App::uses('MeasurementParameter', 'Model');

/**
 * MeasurementParameter Test Case
 *
 */
class MeasurementParameterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.measurement_parameter',
		'app.unit_of_measure'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MeasurementParameter = ClassRegistry::init('MeasurementParameter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MeasurementParameter);

		parent::tearDown();
	}

}
