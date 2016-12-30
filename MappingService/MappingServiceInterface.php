<?php

namespace PlentyConnector\Connector\MappingService;

use PlentyConnector\Connector\Exception\MissingQueryException;
use PlentyConnector\Connector\TransferObject\Definition\DefinitionInterface;
use PlentyConnector\Connector\TransferObject\Mapping\MappingInterface;

/**
 * Interface MappingServiceInterface.
 */
interface MappingServiceInterface
{
    /**
     * @param DefinitionInterface $definition
     */
    public function addDefinition(DefinitionInterface $definition);

    /**
     * @param null $objectType
     *
     * @return MappingInterface[]
     *
     * @throws MissingQueryException
     */
    public function getMappingInformation($objectType = null);
}
