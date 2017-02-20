<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostReward
 *
 * @ORM\Table(name="post_reward")
 * @ORM\Entity
 */
class PostReward
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="binary_value", type="integer", nullable=false)
     */
    private $binaryValue;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=144, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_reward_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     * @return PostReward
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set binaryValue
     *
     * @param integer $binaryValue
     * @return PostReward
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

    /**
     * Set description
     *
     * @param string $description
     * @return PostReward
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return PostReward
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString() {
      return "\r";
    }
}
