<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 06.08.14
 * Time: 21:58
 */

namespace Logger;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class Launcher implements ListenerAggregateInterface {

    protected static $ready = false;

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events) {
        $events->attach('bootstrap', array($this, 'loadLogger'), 100);
    }

    public function loadLogger(EventInterface $e) {
        if (!self::$ready) {
            self::$ready = true;
            /** @var \Zend\Mvc\Application $application */
            $application = $e->getTarget();
            $config = $application->getServiceManager()->get('Config');
            if (isset($config['logger'])) {
                Logger::load($config['logger']);
            }
        }
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events) {}

}