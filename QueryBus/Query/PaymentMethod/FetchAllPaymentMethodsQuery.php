<?php

namespace PlentyConnector\Connector\QueryBus\Query\PaymentMethod;

use PlentyConnector\Connector\QueryBus\Query\FetchAllQueryInterface;

/**
 * Class FetchAllPaymentMethodsQuery.
 */
class FetchAllPaymentMethodsQuery implements FetchAllQueryInterface
{
    /**
     * @var string
     */
    private $adapterName;

    /**
     * FetchAllPaymentMethodsQuery constructor.
     *
     * @param string $adapterName
     */
    public function __construct($adapterName)
    {
        $this->adapterName = $adapterName;
    }

    /**
     * @return string
     */
    public function getAdapterName()
    {
        return $this->adapterName;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return [
            'adapterName' => $this->adapterName,
        ];
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload = [])
    {
        $this->adapterName = $payload['adapterName'];
    }
}
