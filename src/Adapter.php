<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 18:49
 */

namespace Logger;

abstract class Adapter {
    protected $streams;
    protected $defaultStream;
    protected $errorStream;
    protected $defaultLevel;
    protected $defaultFormat;

    public function __construct($defaultStream = null, $defaultLevel = null, $errorStream = null, $defaultFormat = null) {
        $this->defaultFormat = $defaultFormat;
        $this->defaultLevel = $defaultLevel;
        $this->defaultStream = $defaultStream;
        $this->errorStream = $errorStream;
    }

    public function getDefaultStream() {
        if ($this->defaultStream === null) {
            $this->defaultStream = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dao-system.log';
        }
        return $this->defaultStream;
    }

    public function getDefaultLogLevel() {
        if ($this->defaultLevel === null)
            $this->defaultLevel = "info";
        return $this->defaultLevel;
    }

    public function getDefaultErrorStream() {
        if ($this->errorStream === null) {
            $this->errorStream = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dao-error.log';
        }
        return $this->errorStream;
    }

    /**
     * @return string
     */
    public abstract function getDefaultFormat();

    /**
     * @param string $levelName The log level: debug|info|notice|warning|error|critical|alert|emergency
     * @return mixed
     */
    protected abstract function mapLevel($levelName);

    /**
     * @param string $stream
     * @param string $path
     * @param mixed $level
     * @param string $format
     * @param $errorPath
     * @return LoggerInterface
     */
    protected abstract function createLogger($stream, $path, $level, $format, $errorPath);

    /**
     * @param string $stream
     * @param string|null $path
     * @param mixed|null $level
     * @param string|null $format
     * @return LoggerInterface
     */
    public function ensureStream($stream, $path = null, $level = null, $format = null) {
        if (!isset($this->streams[$stream])) {
            $logger = $this->createLogger($stream,
                $path === null ? $this->getDefaultStream() : $path,
                $level === null ? $this->mapLevel($this->getDefaultLogLevel()) : $this->mapLevel($level),
                $format === null ? $this->getDefaultFormat() : $format,
                $this->getDefaultErrorStream()
            );

            $this->streams[$stream] = $logger;
        }
        return $this->streams[$stream];

    }

}