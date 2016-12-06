<?php

/**
 *
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\UserCrappy;

use OC_User_Backend;
use OCP\ILogger;

class CrappyUserBackend extends OC_User_Backend {

	/** @var ILogger */
	private $logger;

	public function __construct() {
		$this->logger = \OC::$server->getLogger();
	}

	public function userExists($uid) {
		$exists = $uid === 'ferdinand';
		//$this->logger->debug("user $uid exists? -> " . ($exists ? 'yes' : 'no'));
		return $exists ? $uid : false;
	}

	public function checkPassword($uid, $password) {
		$valid = $this->userExists($uid) && $password === 'passme';

		// Fail randomly, just because it's fun
		if ($valid) {
			$this->logger->debug("crappy user backend fails now");
			$valid = false;
		}

		$this->logger->debug("password $password valid for $uid? -> " . ($valid ? 'yes' : 'no'));
		return $valid ? $uid : false;
	}

}
