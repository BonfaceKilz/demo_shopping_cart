<?php declare(strict_types=1);
/**
 * PHP Version 7.2
 *
 * DBHandler: Manage mysql connections
 *
 * Copyright (c) 2019 Bonface K. M.
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  Database
 * @package   None
 * @author    Bonface K. M. <bonfacemunyoki@gmail.com>
 * @copyright 2019 Bonface K. M. <bonfacemunyoki@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      None
 */

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * DBHandler Class:
 *
 * Execute raw mysql queries
 *
 * @category  Database
 * @package   None
 * @author    Bonface K. M. <bonfacemunyoki@gmail.com>
 * @copyright 2019 Bonface K. M. <bonfacemunyoki@gmail.com>
 * @license   Bonface K. M. <bonfacemunyoki@gmail.com>
 * @link      None
 */
class DBHandler
{
    /**
     * Initiate a connection by fetching
     * the correct params from .env
     */
    public function __construct()
    {
        $this->conn = mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USER_NAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME')
        );
    }

    /**
     * Run a mysql query
     *
     * @param string $query Execute a simple mysql query
     *
     * @return array
     */
    public function executeQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }
}
?>
