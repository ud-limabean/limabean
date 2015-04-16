<?php
App::uses('StatisticType', 'Model');

/**
 * StatisticType Test Case
 *
 */
class StatisticTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.statistic_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StatisticType = ClassRegistry::init('StatisticType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StatisticType);

		parent::tearDown();
	}

}
