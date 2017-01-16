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
    private $link;

    /**
     * @var string
     */
    private $hash;

    /**
     * Media constructor.
     *
     * @param string $identifier
     * @param string $link
     * @param string|null $hash
     */
    public function __construct(
        $identifier,
        $link,
        $hash = null
    ) {
        Assertion::uuid($identifier);
        Assertion::url($link);
        Assertion::readable($link);
        Assertion::nullOrString($hash);

        $this->identifier = $identifier;
        $this->link = $link;

        if (null === $hash) {
            $hash = sha1_file($link);
        }

        $this->hash = $hash;
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
            'name',
            'link',
        ]);

        return new self(
            $params['identifier'],
            $params['name'],
            $params['link']
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
}
