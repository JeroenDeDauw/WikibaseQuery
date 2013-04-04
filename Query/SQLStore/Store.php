<?php

namespace Wikibase\Query\SQLStore;

use MessageReporter;
use Wikibase\Database\QueryInterface;
use Wikibase\Database\TableBuilder;
use Wikibase\Query\QueryStore;

/**
 * Simple query store for relational SQL databases.
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
 * @since 0.1
 *
 * @file
 * @ingroup WikibaseSQLStore
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Store implements QueryStore {

	/**
	 * @since 0.1
	 *
	 * @var StoreConfig
	 */
	private $config;

	/**
	 * @since 0.1
	 *
	 * @var QueryInterface
	 */
	private $queryInterface;

	/**
	 * @since 0.1
	 *
	 * @var TableBuilder|null
	 */
	private $tableBuilder;

	/**
	 * @since 0.1
	 *
	 * @param StoreConfig $config
	 * @param QueryInterface $queryInterface
	 */
	public function __construct( StoreConfig $config, QueryInterface $queryInterface ) {
		$this->config = $config;
		$this->queryInterface = $queryInterface;
	}

	/**
	 * Sets the table builder to use for creating tables.
	 *
	 * @since 0.1
	 *
	 * @param TableBuilder $tableBuilder
	 */
	public function setTableBuilder( TableBuilder $tableBuilder ) {
		$this->tableBuilder = $tableBuilder;
	}

	/**
	 * @see QueryStore::getName
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	public function getName() {
		return $this->config->getStoreName();
	}

	/**
	 * @see QueryStore::getQueryEngine
	 *
	 * @since 0.1
	 *
	 * @return \Wikibase\Query\QueryEngine
	 */
	public function getQueryEngine() {
		return new Engine( $this->config, $this->queryInterface );
	}

	/**
	 * @see QueryStore::getUpdater
	 *
	 * @since 0.1
	 *
	 * @return \Wikibase\Query\QueryStoreUpdater
	 */
	public function getUpdater() {
		return new Updater( $this->config, $this->queryInterface );
	}

	/**
	 * @see QueryStore::setup
	 *
	 * @since 0.1
	 *
	 * @param MessageReporter $messageReporter
	 *
	 * @return boolean Success indicator
	 */
	public function setup( MessageReporter $messageReporter ) {
		$setup = new Setup( $this->config, $this->queryInterface, $this->tableBuilder, $messageReporter );

		return $setup->install();
	}

	/**
	 * @see QueryStore::drop
	 *
	 * @since 0.1
	 *
	 * @param MessageReporter $messageReporter
	 *
	 * @return boolean Success indicator
	 */
	public function drop( MessageReporter $messageReporter ) {
		$setup = new Setup( $this->config, $this->queryInterface, $this->tableBuilder, $messageReporter );

		return $setup->uninstall();
	}

}
