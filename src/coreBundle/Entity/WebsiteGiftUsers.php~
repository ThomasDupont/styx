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
     * Set styxuserbase
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbase
     * @return WebsiteGiftUsers
     */
    public function setStyxuserbase(\coreBundle\Entity\WebsiteStyxuserbase $styxuserbase = null)
    {
        $this->styxuserbase = $styxuserbase;
    
        return $this;
    }

    /**
     * Get styxuserbase
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getStyxuserbase()
    {
        return $this->styxuserbase;
    }

    /**
     * Set gift
     *
     * @param \coreBundle\Entity\WebsiteGift $gift
     * @return WebsiteGiftUsers
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
