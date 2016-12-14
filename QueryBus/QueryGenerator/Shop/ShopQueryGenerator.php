<?php

namespace PlentyConnector\Connector\QueryBus\QueryGenerator\Shop;

use PlentyConnector\Connector\QueryBus\Query\Shop\FetchAllShopsQuery;
use PlentyConnector\Connector\QueryBus\Query\Shop\FetchChangedShopsQuery;
use PlentyConnector\Connector\QueryBus\QueryGenerator\QueryGeneratorInterface;
use PlentyConnector\Connector\TransferObject\TransferObjectType;

/**
 * Class ShopQueryGenerator
 */
class ShopQueryGenerator implements QueryGeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($transferObjectType)
    {
        return $transferObjectType === TransferObjectType::SHOP;
    }

    /**
     * {@inheritdoc}
     */
    public function generateFetchChangedQuery($adapterName)
    {
        return new FetchChangedShopsQuery($adapterName);
    }

    /**
     * {@inheritdoc}
     */
    public function generateFetchAllQuery($adapterName)
    {
        return new FetchAllShopsQuery($adapterName);
    }

    /**
     * {@inheritdoc}
     */
    public function generateFetchQuery($adapterName, $identifier)
    {
        return new FetchChangedShopsQuery($adapterName, $identifier);
    }
}
