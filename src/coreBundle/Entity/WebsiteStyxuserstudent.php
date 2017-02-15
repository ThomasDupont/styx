<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserstudent
 *
 * @ORM\Table(name="website_styxuserstudent", indexes={@ORM\Index(name="website_styxuserstudent_28883a1b", columns={"sponsorship_id"}), @ORM\Index(name="website_styxuserstudent_5fc7164b")})
 * @ORM\Entity
 */
class WebsiteStyxuserstudent {

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserbase_ptr_id", referencedColumnName="id")
     * })
     */
    private $styxuserbasePtr;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sponsorship_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $sponsorship;




    /**
     * Set styxuserbasePtr
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbasePtr
     * @return WebsiteStyxuserstudent
     */
    public function setStyxuserbasePtr(\coreBundle\Entity\WebsiteStyxuserbase $styxuserbasePtr)
    {
        $this->styxuserbasePtr = $styxuserbasePtr;
    
        return $this;
    }

    /**
     * Get styxuserbasePtr
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getStyxuserbasePtr()
    {
        return $this->styxuserbasePtr;
    }

    /**
     * Set sponsorship
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $sponsorship
     * @return WebsiteStyxuserstudent
     */
    public function setSponsorship(\coreBundle\Entity\WebsiteStyxuserstudent $sponsorship = null)
    {
        $this->sponsorship = $sponsorship;
    
        return $this;
    }

    /**
     * Get sponsorship
     *
     * @return \coreBundle\Entity\WebsiteStyxuserstudent 
     */
    public function getSponsorship()
    {
        return $this->sponsorship;
    }
}
