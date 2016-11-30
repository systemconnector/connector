<?php

namespace PlentyConnector\Connector\QueryBus\Query\Manufacturer;

use PlentyConnector\Connector\QueryBus\Query\FetchOneQueryInterface;

/**
 * Class FetchManufacturerQuery
 */
class FetchManufacturerQuery implements FetchOneQueryInterface
{
    /**
     * @var string
     */
    private $adapterName;

    /**
     * @var string
     */
    private $identifier;

    /**
     * FetchManufacturerQuery constructor.
     *
     * @param string $adapterName
     * @param $identifier
     */
    public function __construct($adapterName, $identifier)
    {
        $this->adapterName = $adapterName;
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getAdapterName()
    {
        return $this->adapterName;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return [
            'adapterName' => $this->adapterName,
            'identifier' => $this->identifier,
        ];
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload = [])
    {
        $this->adapterName = $payload['adapterName'];
        $this->identifier = $payload['identifier'];
    }
}
