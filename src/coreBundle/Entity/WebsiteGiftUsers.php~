<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteGiftUsers
 *
 * @ORM\Table(name="website_gift_users", uniqueConstraints={@ORM\UniqueConstraint(name="website_gift_users_gift_id_001d5ab0_uniq", columns={"gift_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="website_gift_users_addd09df", columns={"gift_id"}), @ORM\Index(name="website_gift_users_b694f505", columns={"styxuserbase_id"})})
 * @ORM\Entity
 */
class WebsiteGiftUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_gift_users_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsiteGift
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteGift")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gift_id", referencedColumnName="id")
     * })
     */
    private $gift;


}
