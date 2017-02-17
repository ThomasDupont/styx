<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use coreBundle\Entity\WebsiteZone;

/**
 * WebsiteStyxuserbaseZones
 *
 * @ORM\Table(name="website_styxuserbase_zones", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserbase_zones_styxuserbase_id_a8f773a2_uniq", columns={"styxuserbase_id", "zone_id"})}, indexes={@ORM\Index(name="website_styxuserbase_zones_06342dd7", columns={"zone_id"}), @ORM\Index(name="website_styxuserbase_zones_b694f505", columns={"styxuserbase_id"})})
 * @ORM\Entity
 */
class WebsiteStyxuserbaseZones
{

  // public function __construct($styxuserbase) {
  //   $this->id = 1;
  //   $this->zone = new WebsiteZone();
  //   $this->styxuserbase = $styxuserbase;
  // }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserbase_zones_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserbase_id", referencedColumnName="id")
     * })
     */
    private $styxuserbase;

    public function getStyxuserbase() {
      return $this->styxuserbase;
    }

    public function getZone() {
      return $this->zone;
    }

    public function getId() {
      return $this->id;
    }

    /**
     * Set zone
     *
     * @param \coreBundle\Entity\WebsiteZone $zone
     * @return WebsiteStyxuserbaseZones
     */
    public function setZone(\coreBundle\Entity\WebsiteZone $zone = null)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Set styxuserbase
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbase
     * @return WebsiteStyxuserbaseZones
     */
    public function setStyxuserbase(\coreBundle\Entity\WebsiteStyxuserbase $styxuserbase = null)
    {
        $this->styxuserbase = $styxuserbase;
    
        return $this;
    }
}
