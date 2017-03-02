<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteGiftZone
 *
 * @ORM\Table(name="website_gift_zone", uniqueConstraints={@ORM\UniqueConstraint(name="website_gift_zone_gift_id_57f2968f_uniq", columns={"gift_id", "zone_id"})}, indexes={@ORM\Index(name="website_gift_zone_addd09df", columns={"gift_id"}), @ORM\Index(name="website_gift_zone_06342dd7", columns={"zone_id"})})
 * @ORM\Entity
 */
class WebsiteGiftZone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_gift_zone_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsiteGift
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteGift")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gift_id", referencedColumnName="id")
     * })
     */
    private $gift;



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
     * @return WebsiteGiftZone
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

    /**
     * Set gift
     *
     * @param \coreBundle\Entity\WebsiteGift $gift
     * @return WebsiteGiftZone
     */
    public function setGift(\coreBundle\Entity\WebsiteGift $gift = null)
    {
        $this->gift = $gift;
    
        return $this;
    }

    /**
     * Get gift
     *
     * @return \coreBundle\Entity\WebsiteGift 
     */
    public function getGift()
    {
        return $this->gift;
    }
}
