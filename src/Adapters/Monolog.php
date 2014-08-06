<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 19:34
 */

namespace Logger\Adapters;

use Logger\Adapters\Monolog\MonologWrapper;
use Logger\LoggerInterface;
use Logger\Adapter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zend\Debug\Debug;

class Monolog extends Adapter {
    /**
     * @return string
     */
    public function getDefaultFormat() {
        return "[%datetime%] [%level_name%] [%extra.session-id%] %channel%: %message% %context% %extra%\n";
    }

    /**
     * @param string $levelName The log level: debug|info|notice|warning|error|critical|alert|emergency
     * @return mixed
     */
    protected function mapLevel($levelName) {
        $levels = Logger::getLevels();
        if (array_key_exists(strtoupper($levelName), $levels)) {
            return $levels[strtoupper($levelName)];
        }
        return Logger::INFO;
    }

    /**
     * @param string $stream
     * @param string $path
     * @param mixed $level
     * @param string $format
     * @param $errorPath
     * @return LoggerInterface
     */
    protected function createLogger($stream, $path, $level, $format, $errorPath) {
        $defaultHandler = new RotatingFileHandler($path, 0, $level);
        $defaultHandler->setFormatter(new LineFormatter($format));

        $logger = new MonologWrapper($stream, array($defaultHandler));

        if ($path !== $errorPath) {
            $errorHandler = new RotatingFileHandler($errorPath, 0, Logger::ERROR);
            $errorHandler->setFormatter(new LineFormatter($format));
            $logger->pushHandler($errorHandler);
        }


        return $logger;
    }

}