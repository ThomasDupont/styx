<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteGroup
 *
 * @ORM\Table(name="website_group")
 * @ORM\Entity
 */
class WebsiteGroup
{

  // public function __construct() {
  //   $this->id = 2;
  //   $this->name = "student";
  //   $this->binaryValue = 2;
  // }
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="binary_value", type="integer", nullable=false)
     */
    private $binaryValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_group_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    public function getId() {
      return $this->id;
    }

    public function getName() {
      return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WebsiteGroup
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Set binaryValue
     *
     * @param integer $binaryValue
     * @return WebsiteGroup
     */
    public function setBinaryValue($binaryValue)
    {
        $this->binaryValue = $binaryValue;
    
        return $this;
    }

    /**
     * Get binaryValue
     *
     * @return integer 
     */
    public function getBinaryValue()
    {
        return $this->binaryValue;
    }
}
