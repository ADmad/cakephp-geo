<?php

namespace Geo\Test\TestCase\Controller\Admin;

use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * @uses \Geo\Controller\Admin\GeocodedAddressesController
 */
class GeocodedAddressesControllerTest extends TestCase {

	use IntegrationTestTrait;

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
		'plugin.Geo.GeocodedAddresses',
	];

	/**
	 * @return void
	 */
	public function setUp(): void {
		parent::setUp();

		Router::reload();
	}

	/**
	 * Test index method
	 *
	 * @return void
	 */
	public function testIndex() {
		$this->disableErrorHandlerMiddleware();

		$this->get(['prefix' => 'Admin', 'plugin' => 'Geo', 'controller' => 'GeocodedAddresses', 'action' => 'index']);

		$this->assertResponseCode(200);
	}

}
