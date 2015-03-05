<?php
App::uses('Locality', 'Model');

/**
 * Locality Test Case
 *
 */
class LocalityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.locality'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Locality = ClassRegistry::init('Locality');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Locality);

		parent::tearDown();
	}

}
