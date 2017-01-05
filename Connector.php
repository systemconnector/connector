<?php

namespace PlentyConnector\Connector;

use Assert\Assertion;
use PlentyConnector\Adapter\AdapterInterface;
use PlentyConnector\Connector\CommandBus\Command\CommandInterface;
use PlentyConnector\Connector\CommandBus\CommandFactory\CommandFactory;
use PlentyConnector\Connector\CommandBus\CommandType;
use PlentyConnector\Connector\EventBus\Event\EventInterface;
use PlentyConnector\Connector\Exception\MissingCommandException;
use PlentyConnector\Connector\Exception\MissingQueryException;
use PlentyConnector\Connector\QueryBus\Query\QueryInterface;
use PlentyConnector\Connector\QueryBus\QueryFactory\QueryFactory;
use PlentyConnector\Connector\QueryBus\QueryType;
use PlentyConnector\Connector\ServiceBus\ServiceBusInterface;
use PlentyConnector\Connector\TransferObject\Definition\DefinitionInterface;
use PlentyConnector\Connector\TransferObject\TransferObjectInterface;

/**
 * TODO: error and exception handling
 *
 * Class Connector.
 */
class Connector implements ConnectorInterface
{
    /**
     * @var AdapterInterface[]|null
     */
    private $adapters = [];

    /**
     * @var DefinitionInterface[]|null
     */
    private $definitions = [];

    /**
     * @var ServiceBusInterface
     */
    private $queryBus;

    /**
     * @var ServiceBusInterface
     */
    private $commandBus;

    /**
     * @var ServiceBusInterface
     */
    private $eventBus;

    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var CommandFactory
     */
    private $commandFactory;

    /**
     * Connector constructor.
     *
     * @param ServiceBusInterface $queryBus
     * @param ServiceBusInterface $commandBus
     * @param ServiceBusInterface $eventBus
     * @param QueryFactory $queryFactory
     * @param CommandFactory $commandFactory
     */
    public function __construct(
        ServiceBusInterface $queryBus,
        ServiceBusInterface $commandBus,
        ServiceBusInterface $eventBus,
        QueryFactory $queryFactory,
        CommandFactory $commandFactory
    ) {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->eventBus = $eventBus;
        $this->queryFactory = $queryFactory;
        $this->commandFactory = $commandFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function addAdapter(AdapterInterface $adapters)
    {
        $this->adapters[] = $adapters;
    }

    /**
     * {@inheritdoc}
     */
    public function addDefinition(DefinitionInterface $definition)
    {
        $this->definitions[] = $definition;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($queryType, $objectType = null, $identifier = null)
    {
        Assertion::InArray($queryType, QueryType::getAllTypes());
        Assertion::nullOrstring($objectType);

        if ($queryType === QueryType::ONE) {
            Assertion::notNull($identifier);
            Assertion::uuid($identifier);
        }

        $definitions = $this->getDefinitions($objectType);

        if (null === $definitions) {
            $definitions = [];
        }

        array_walk($definitions, function (DefinitionInterface $definition) use ($queryType, $identifier) {
            $this->handleDefinition($definition, $queryType, $identifier);
        });
    }

    /**
     * @param string|null $type
     *
     * @return DefinitionInterface[]|null
     */
    private function getDefinitions($type = null)
    {
        if (null === count($this->definitions)) {
            return [];
        }

        $definitions = array_filter($this->definitions, function (DefinitionInterface $definition) use ($type) {
            return $definition->getObjectType() === $type || null === $type;
        });

        return $definitions;
    }

    /**
     * @param DefinitionInterface $definition
     * @param integer $queryType
     * @param string|null $identifier
     *
     * @throws MissingQueryException
     * @throws MissingCommandException
     */
    private function handleDefinition(DefinitionInterface $definition, $queryType, $identifier = null)
    {
        $query = $this->queryFactory->create(
            $definition->getOriginAdapterName(),
            $definition->getObjectType(),
            $queryType,
            $identifier
        );

        if (null === $query) {
            throw MissingQueryException::fromDefinition($definition);
        }

        /**
         * @var TransferObjectInterface[] $objects
         */
        $objects = $this->queryBus->handle($query);

        if (null === $objects) {
            $objects = [];
        }

        array_walk($objects, function (TransferObjectInterface $object) use ($definition) {
            $command = $this->commandFactory->create(
                $object,
                $definition->getDestinationAdapterName(),
                CommandType::HANDLE
            );

            if (null === $command) {
                throw MissingCommandException::fromDefinition($definition);
            }

            $this->handleCommand($command);
        });
    }

    /**
     * @param CommandInterface $command
     */
    private function handleCommand(CommandInterface $command)
    {
        try {
            $this->commandBus->handle($command);
        } catch (\Exception $exception) {
            // TODO: finalize
        }
    }
}
