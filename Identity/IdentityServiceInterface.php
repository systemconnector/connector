<?php

namespace PlentyConnector\Connector\Identity;

use PlentyConnector\Connector\TransferObject\Identity\IdentityInterface;

/**
 * Interface IdentityServiceInterface
 *
 * @package PlentyConnector\Connector\Identity
 */
interface IdentityServiceInterface
{
    /**
     * @param array $criteria
     *
     * @return IdentityInterface
     */
    public function findIdentity(array $criteria = []);

    /**
     * @param string $objectIdentifier
     * @param string $objectType
     * @param string $adapterIdentifier
     * @param string $adapterName
     *
     * @return IdentityInterface
     */
    public function createIdentity($objectIdentifier, $objectType, $adapterIdentifier, $adapterName);

    /**
     * @param string $adapterIdentifier
     * @param string $adapterName
     * @param string $objectType
     *
     * @return IdentityInterface
     */
    public function findOrCreateIdentity($adapterIdentifier, $adapterName, $objectType);
}
