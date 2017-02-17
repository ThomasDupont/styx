<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserassociation
 *
 * @ORM\Table(name="website_styxuserassociation")
 * @ORM\Entity
 */
class WebsiteStyxuserassociation
{
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
     * Set styxuserbasePtr
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbasePtr
     * @return WebsiteStyxuserassociation
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
}
