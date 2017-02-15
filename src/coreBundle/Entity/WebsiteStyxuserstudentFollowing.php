<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserstudentFollowing
 *
 * @ORM\Table(name="website_styxuserstudent_following", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserstudent_follow_styxuserstudent_id_014cb408_uniq", columns={"styxuserstudent_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="website_styxuserstudent_following_abd26065", columns={"styxuserstudent_id"}), @ORM\Index(name="website_styxuserstudent_following_b694f505", columns={"styxuserbase_id"})})
 * @ORM\Entity
 */
class WebsiteStyxuserstudentFollowing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserstudent_following_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserstudent_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $styxuserstudent;



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
     * @return WebsiteStyxuserstudentFollowing
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
     * Set styxuserstudent
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent
     * @return WebsiteStyxuserstudentFollowing
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
}
