<?php
App::uses('LbMeasurementAvg', 'Model');

/**
 * LbMeasurementAvg Test Case
 *
 */
class LbMeasurementAvgTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lb_measurement_avg',
		'app.div_field'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LbMeasurementAvg = ClassRegistry::init('LbMeasurementAvg');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LbMeasurementAvg);

		parent::tearDown();
	}

}
