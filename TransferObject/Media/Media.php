<?php

namespace PlentyConnector\Connector\TransferObject\Media;

use Assert\Assertion;

/**
 * Class Media
 */
class Media implements MediaInterface
{
    const TYPE = 'Media';

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $mediaCategoryIdentifier;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alternateName;

    /**
     * @var array
     */
    private $translations;

    /**
     * @var array
     */
    private $attributes;

    /**
     * Media constructor.
     *
     * @param string $identifier
     * @param string $mediaCategoryIdentifier
     * @param string $link
     * @param string $name
     * @param string $alternateName
     * @param string|null $hash
     * @param array $translations
     * @param array $attributes
     */
    public function __construct(
        $identifier,
        $mediaCategoryIdentifier = null,
        $link,
        $name,
        $alternateName,
        $hash = null,
        array $translations = [],
        array $attributes = []
    ) {
        Assertion::uuid($identifier);
        Assertion::nullOrUuid($mediaCategoryIdentifier);
        Assertion::url($link);
        Assertion::string($name);
        Assertion::string($alternateName);

        $this->identifier = $identifier;
        $this->mediaCategoryIdentifier = $mediaCategoryIdentifier;
        $this->link = $link;

        $this->name = $name;
        $this->alternateName = $alternateName;

        if (empty($hash)) {
            $hash = sha1_file($link);
        }

        Assertion::string($hash);

        $this->hash = $hash;
        $this->translations = $translations;
        $this->attributes = $attributes;
    }

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
    public static function fromArray(array $params = [])
    {
        Assertion::allInArray(array_keys($params), [
            'identifier',
            'mediaCategoryIdentifier',
            'link',
            'hash',
            'name',
            'alternateName',
            'translations',
            'attributes',
        ]);

        return new self(
            $params['identifier'],
            $params['mediaCategoryIdentifier'],
            $params['link'],
            $params['name'],
            $params['alternateName'],
            $params['hash'],
            $params['translations'],
            $params['attributes']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaCategoryIdentifier()
    {
        return $this->mediaCategoryIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
