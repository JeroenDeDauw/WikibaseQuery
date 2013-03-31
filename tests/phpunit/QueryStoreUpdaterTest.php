<?php

namespace Wikibase\Test\Query;

use Wikibase\Query\QueryStore;

/**
 * Base test class for Wikibase\Query\QueryStore implementing classes.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @since 0.1
 *
 * @ingroup WikibaseQueryTest
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class QueryStoreUpdaterTest extends \MediaWikiTestCase {

	/**
	 * @since 0.1
	 *
	 * @return QueryStore[]
	 */
	protected abstract function getInstances();

	/**
	 * @since 0.1
	 *
	 * @return QueryStore[][]
	 */
	public function instanceProvider() {
		return $this->arrayWrap( $this->getInstances() );
	}

	public function testInsertEntity() {
		// TODO
		$this->assertTrue( true );
	}

	public function testUpdateEntity() {
		// TODO
		$this->assertTrue( true );
	}

	public function testDeleteEntity() {
		// TODO
		$this->assertTrue( true );
	}

}
