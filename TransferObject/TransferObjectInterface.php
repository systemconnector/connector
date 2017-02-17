<?php

namespace PlentyConnector\Connector\TransferObject;

/**
 * Class TransferObjectInterface.
 */
interface TransferObjectInterface
{
    /**
     * return a uuid.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * return the unique type of the object.
     *
     * @return string
     */
    public function getType();
}
