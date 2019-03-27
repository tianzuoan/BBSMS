<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 17:19
 */

namespace BBSMS\Event;

use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\ManagerInterface;

class BaseEvent implements EventsAwareInterface
{
    protected $_eventsManager;

    /**
     * Sets the events manager
     *
     * @param ManagerInterface $eventsManager
     */
    public function setEventsManager(ManagerInterface $eventsManager)
    {
        // TODO: Implement setEventsManager() method.
        $this->_eventsManager = $eventsManager;
    }

    /**
     * Returns the internal event manager
     *
     * @return ManagerInterface
     */
    public function getEventsManager()
    {
        // TODO: Implement getEventsManager() method.
        return $this->_eventsManager;
    }
}