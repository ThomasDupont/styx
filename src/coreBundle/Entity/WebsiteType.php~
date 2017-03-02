<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteType
 *
 * @ORM\Table(name="website_type")
 * @ORM\Entity
 */
class WebsiteType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7, nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="binary_value", type="string", length=10, nullable=false)
     */
    private $binaryValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set name
     *
     * @param string $name
     * @return WebsiteType
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return WebsiteType
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set binaryValue
     *
     * @param string $binaryValue
     * @return WebsiteType
     */
    public function setBinaryValue($binaryValue)
    {
        $this->binaryValue = $binaryValue;
    
        return $this;
    }

    /**
     * Get binaryValue
     *
     * @return string 
     */
    public function getBinaryValue()
    {
        return $this->binaryValue;
    }
}
