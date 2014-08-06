<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 18:10
 */

namespace Logger;

interface LoggerInterface {
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function debug($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function info($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function notice($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function warning($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function error($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function critical($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function alert($message, array $context = array());
    /**
     * @param string $message The log message
     * @param array  $context The log context
     */
    public function emergency($message, array $context = array());
}