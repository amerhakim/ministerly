<?php
/**
 * The Front Controller for handling every request
 *
 * Classera EMS (Education Management System)
 * Copyright (c) 2024 Classera. All rights reserved.
 *
 * Licensed under the GNU General Public License version 2 (GPL-2.0)
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2024 Classera
 * @link          https://classera.com Classera EMS Project
 * @since         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */
// for built-in server
if (php_sapi_name() === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url(urldecode($_SERVER['REQUEST_URI']));
    $file = __DIR__ . $url['path'];
    if (strpos($url['path'], '..') === false && strpos($url['path'], '.') !== false && is_file($file)) {
        return false;
    }
}
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

// Bind your application to the server.
$server = new Server(new Application(dirname(__DIR__) . '/config'));

// Run the request/response through the application
// and emit the response.
try {
    $server->emit($server->run());
} catch (Exception $ex) {
    $ErrorTable = TableRegistry::get('System.SystemErrors');
    $ErrorTable->insertError($ex);
    Log::write('error', $ex);
    throw $ex;
}
