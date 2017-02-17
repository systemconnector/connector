<?php

namespace PlentyConnector\Connector\TransferObject\Manufacturer;

use Assert\Assertion;
use PlentyConnector\Connector\TransferObject\AbstractTransferObject;

/**
 * Class TransferObjects.
 */
class Manufacturer extends AbstractTransferObject
{
    const TYPE = 'Manufacturer';

    /**
     * @var string
     */
    private $identifier = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $logoIdentifier = '';

    /**
     * @var string
     */
    private $link = '';

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return self::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        Assertion::notBlank($this->identifier);

        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        Assertion::uuid($identifier);

        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        Assertion::string($name);
        Assertion::notBlank($name);

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLogoIdentifier()
    {
        return $this->logoIdentifier;
    }

    /**
     * @param string $logoIdentifier
     */
    public function setLogoIdentifier($logoIdentifier)
    {
        Assertion::nullOrUuid($logoIdentifier);

        $this->logoIdentifier = $logoIdentifier;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        Assertion::nullOrUrl($link);

        $this->link = $link;
    }
}
