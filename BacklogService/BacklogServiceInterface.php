<?php

namespace PlentyConnector\Connector\BacklogService;

use PlentyConnector\Connector\ServiceBus\Command\CommandInterface;

/**
 * Interface BacklogServiceInterface
 */
interface BacklogServiceInterface
{
    /**
     * @param CommandInterface $command
     */
    public function enqueue(CommandInterface $command);

    /**
     * @return CommandInterface
     */
    public function dequeue();
}
