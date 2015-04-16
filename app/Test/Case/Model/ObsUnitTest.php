<?php
App::uses('ObsUnit', 'Model');

/**
 * ObsUnit Test Case
 *
 */
class ObsUnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.obs_unit',
		'app.div_field',
		'app.div_stock',
		'app.div_mate_connect'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ObsUnit = ClassRegistry::init('ObsUnit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ObsUnit);

		parent::tearDown();
	}

}
