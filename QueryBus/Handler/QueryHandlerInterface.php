<?php

namespace PlentyConnector\Connector\QueryBus\Handler;

use PlentyConnector\Connector\QueryBus\Query\QueryInterface;

/**
 * Interface QueryHandlerInterface
 *
 * @package PlentyConnector\Connector\QueryBus\Handler
 */
interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $event
     *
     * @return bool
     */
    public function supports($event);

    /**
     * @param QueryInterface $event
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function handle($event);
}
