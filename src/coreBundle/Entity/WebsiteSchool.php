<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* WebsiteSchool
*
* @ORM\Table(name="website_school", indexes={@ORM\Index(name="website_school_06342dd7", columns={"zone_id"})})
* @ORM\Entity
*/
class WebsiteSchool
{
  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=100, nullable=false)
  */
  private $name;

  /**
  * @var integer
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="SEQUENCE")
  * @ORM\SequenceGenerator(sequenceName="website_school_id_seq", allocationSize=1, initialValue=1)
  */
  private $id;

  /**
  * @var \coreBundle\Entity\WebsiteZone
  *
  * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteZone")
  * @ORM\JoinColumns({
  *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
  * })
  */
  private $zone;

  /**
  * Set name
  *
  * @param string $name
  * @return WebsiteSchool
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
  * Get id
  *
  * @return integer
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set zone
  *
  * @param \coreBundle\Entity\WebsiteZone $zone
  * @return WebsiteSchool
  */
  public function setZone(\coreBundle\Entity\WebsiteZone $zone = null)
  {
    $this->zone = $zone;

    return $this;
  }

  /**
  * Get zone
  *
  * @return \coreBundle\Entity\WebsiteZone
  */
  public function getZone()
  {
    return $this->zone;
  }
}
