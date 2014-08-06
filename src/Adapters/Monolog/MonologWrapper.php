<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 19:37
 */

namespace Logger\Adapters\Monolog;

use Logger\LoggerInterface;
use Monolog\Logger;

class MonologWrapper extends Logger implements LoggerInterface {}