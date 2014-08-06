<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 18:47
 */

namespace Logger;

use Logger\Exception\WrongLoggerConfigurationException;

class Logger {

    /** @var  Adapter */
    protected static $provider;

    public static function load(array $options = array()) {
        $adapterClass = isset($options['adapter']) ? $options['adapter'] : '\\Logger\\Adapters\\Monolog';
        if (!class_exists($adapterClass)) {
            switch (strtolower($adapterClass)) {
                case 'monolog':
                    $adapterClass = '\\Logger\\Adapters\\Monolog';
                    break;
            }
        }
        if (class_exists($adapterClass) && is_subclass_of($adapterClass, '\\Logger\\Adapter')) {
            /** @var Adapter $adapter */
            $adapter = new $adapterClass(
                isset($options['system']) ? $options['system'] : null,
                isset($options['level']) ? $options['level'] : null,
                isset($options['error']) ? $options['error'] : null,
                isset($options['format']) ? $options['format'] : null
            );
            $logger = $adapter->ensureStream('system');
            $adapter->ensureStream('error', $adapter->getDefaultErrorStream(), 'error');
//            if (isset($options['streams']) && is_array($options['streams'])) {
//                foreach ($options['streams'] as $stream => $streamOptions) {
                foreach ($options as $stream => $streamOptions) {
                    if (!is_array($streamOptions)) continue;
                    $adapter->ensureStream($stream,
                        is_array($streamOptions) && isset($streamOptions['path']) ? $streamOptions['path'] : null,
                        is_array($streamOptions) && isset($streamOptions['level']) ? $streamOptions['level'] : null,
                        is_array($streamOptions) && isset($streamOptions['format']) ? $streamOptions['format'] : null
                    );
                }
//            }
            $logger->critical('Logger loaded! ' . $adapter->getDefaultLogLevel());
            self::$provider = $adapter;
            return;
        }
        throw new WrongLoggerConfigurationException("$adapterClass doesn't inherit \\Logger\\Adapter");
    }

    /**
     * @param string $stream The log stream name
     * @return LoggerInterface
     */
    public static function getLogger($stream) {
        if (!self::$provider)
            self::load();
        return self::$provider->ensureStream($stream);
    }
}