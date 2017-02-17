<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostPromocodeUsers
 *
 * @ORM\Table(name="post_promocode_users", uniqueConstraints={@ORM\UniqueConstraint(name="post_promocode_users_promocode_id_b24393e8_uniq", columns={"promocode_id", "styxuserstudent_id"})}, indexes={@ORM\Index(name="post_promocode_users_abd26065", columns={"styxuserstudent_id"}), @ORM\Index(name="post_promocode_users_7322a1e6", columns={"promocode_id"})})
 * @ORM\Entity
 */
class PostPromocodeUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_promocode_users_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserstudent_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $styxuserstudent;

    /**
     * @var \coreBundle\Entity\PostPromocode
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostPromocode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promocode_id", referencedColumnName="post_ptr_id")
     * })
     */
    private $promocode;



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
     * Set styxuserstudent
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent
     * @return PostPromocodeUsers
     */
    public function setStyxuserstudent(\coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent = null)
    {
        $this->styxuserstudent = $styxuserstudent;

        return $this;
    }

    /**
     * Get styxuserstudent
     *
     * @return \coreBundle\Entity\WebsiteStyxuserstudent 
     */
    public function getStyxuserstudent()
    {
        return $this->styxuserstudent;
    }

    /**
     * Set promocode
     *
     * @param \coreBundle\Entity\PostPromocode $promocode
     * @return PostPromocodeUsers
     */
    public function setPromocode(\coreBundle\Entity\PostPromocode $promocode = null)
    {
        $this->promocode = $promocode;

        return $this;
    }

    /**
     * Get promocode
     *
     * @return \coreBundle\Entity\PostPromocode 
     */
    public function getPromocode()
    {
        return $this->promocode;
    }
}
