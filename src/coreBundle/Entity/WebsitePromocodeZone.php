<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsitePromocodeZone
 *
 * @ORM\Table(name="website_promocode_zone", uniqueConstraints={@ORM\UniqueConstraint(name="website_promocode_zone_promocode_id_1e412331_uniq", columns={"promocode_id", "zone_id"})}, indexes={@ORM\Index(name="website_promocode_zone_06342dd7", columns={"zone_id"}), @ORM\Index(name="website_promocode_zone_7322a1e6", columns={"promocode_id"})})
 * @ORM\Entity
 */
class WebsitePromocodeZone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_promocode_zone_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsitePromocode
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsitePromocode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promocode_id", referencedColumnName="id")
     * })
     */
    private $promocode;


}
