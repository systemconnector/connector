<?php

namespace PlentyConnector\Connector\QueryBus\Query\PaymentMethod;

use Assert\Assertion;
use PlentyConnector\Connector\QueryBus\Query\FetchChangedQueryInterface;

/**
 * Class FetchChangedPaymentMethodsQuery.
 */
class FetchChangedPaymentMethodsQuery implements FetchChangedQueryInterface
{
    /**
     * @var string
     */
    private $adapterName;

    /**
     * FetchChangedPaymentMethodsQuery constructor.
     *
     * @param string $adapterName
     */
    public function __construct($adapterName)
    {
        Assertion::string($adapterName);

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
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return [
            'adapterName' => $this->adapterName,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setPayload(array $payload = [])
    {
        $this->adapterName = $payload['adapterName'];
    }
}
