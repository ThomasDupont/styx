<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsitePromocodeUsers
 *
 * @ORM\Table(name="website_promocode_users", uniqueConstraints={@ORM\UniqueConstraint(name="website_promocode_users_promocode_id_37595e8c_uniq", columns={"promocode_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="website_promocode_users_b694f505", columns={"styxuserbase_id"}), @ORM\Index(name="website_promocode_users_7322a1e6", columns={"promocode_id"})})
 * @ORM\Entity
 */
class WebsitePromocodeUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_promocode_users_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserbase_id", referencedColumnName="id")
     * })
     */
    private $styxuserbase;

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
