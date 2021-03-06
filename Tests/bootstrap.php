<?php

/**
 * PHPUnit test bootstrap file for the Wikibase Query extension.
 *
 * @since 0.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

require_once( __DIR__ . '/evilMediaWikiBootstrap.php' );

require_once( __DIR__ . '/../../Wikibase/repo/ExampleSettings.php' );

require_once( __DIR__ . '/../../WikibaseDataModel/tests/testLoader.php' );

require_once( __DIR__ . '/../WikibaseQuery.php' );
