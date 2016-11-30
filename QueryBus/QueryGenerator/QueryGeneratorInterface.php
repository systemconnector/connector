<?php


namespace PlentyConnector\Connector\QueryBus\QueryGenerator;


use PlentyConnector\Connector\QueryBus\Query\QueryInterface;

/**
 * Interface QueryGeneratorInterface
 */
interface QueryGeneratorInterface
{
    /**
     * @param string $transferObjectType
     *
     * @return boolean
     */
    public function supports($transferObjectType);

    /**
     * @param string $adapterName
     *
     * @return QueryInterface
     */
    public function generateFetchChangedQuery($adapterName);

    /**
     * @param string $adapterName
     *
     * @return QueryInterface
     */
    public function generateFetchAllQuery($adapterName);

    /**
     * @param string $adapterName
     * @param string $identifier
     *
     * @return QueryInterface
     */
    public function generateFetchQuery($adapterName, $identifier);
}
