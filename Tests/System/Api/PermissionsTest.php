<?php

namespace Tests\System\Wikibase\Query\Api;

use Wikibase\Test\Api\PermissionsTestCase;

//TODO FIXME where to put this?
require_once( __DIR__ . '/ApiTestSetup.php' );

/**
 * @group WikibaseQuery
 * @group WikibaseQuerySystem
 * @group Database
 * @group large
 * @group Api
 *
 * @licence GNU GPL v2+
 * @author Adam Shorland
 */
class PermissionsTest extends PermissionsTestCase {

	const MODULE_NAME = 'entitiesbypropertyvalue';
	const PROPERTY_ID_STRING = 'P31337';
	const ITEM_ID_STRING = 'Q42';

	/**
	 * @var ApiTestSetup
	 */
	protected $apiTestSetup;

	public function setUp() {
		parent::setUp();
		$this->apiTestSetup = new ApiTestSetup( self::ITEM_ID_STRING, self::PROPERTY_ID_STRING );
		$this->apiTestSetup->setUp();
	}

	public function tearDown() {
		parent::tearDown();
		$this->apiTestSetup->tearDown();
	}

	/**
	 * @dataProvider provideTestEntitiesByPropertyValue
	 */
	public function testEntitiesByPropertyValue( $permissions, $expectedError ) {
		$params = array(
			'property' => self::PROPERTY_ID_STRING,
			'value' => '{"value":"API tests really suck","type":"string"}',
		);

		$this->doPermissionsTest( 'entitiesbypropertyvalue', $params, $permissions, $expectedError );
		//TODO the below check should be pushed into the above method
		if( $expectedError === null ) {
			$this->assertTrue( true );
		}
	}

	public static function provideTestEntitiesByPropertyValue() {
		return array(
			array( //0
				null, // normal permissions
				null // no error
			),

			array( //1
				array( // permissions
					'*'    => array( 'wikibase-query-run' => false ),
					'user' => array( 'wikibase-query-run' => false )
				),
				'permissiondenied' // error
			),
		);
	}

} 