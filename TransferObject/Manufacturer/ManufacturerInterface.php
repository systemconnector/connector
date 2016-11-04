<?php

namespace PlentyConnector\Connector\TransferObject\Manufacturer;

use PlentyConnector\Connector\TransferObject\NameableInterface;

/**
 * Interface ManufacturerInterface.
 */
interface ManufacturerInterface extends IdentifiedTransferObject
{
    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getLogo();

    /**
     * @return string
     */
    public function getLink();
}
