<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ThumbnailKvstore
 *
 * @ORM\Table(name="thumbnail_kvstore", indexes={@ORM\Index(name="thumbnail_kvstore_key_3f850178_like", columns={"key"})})
 * @ORM\Entity
 */
class ThumbnailKvstore
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=200)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="thumbnail_kvstore_key_seq", allocationSize=1, initialValue=1)
     */
    private $key;



    /**
     * Set value
     *
     * @param string $value
     * @return ThumbnailKvstore
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }
}
