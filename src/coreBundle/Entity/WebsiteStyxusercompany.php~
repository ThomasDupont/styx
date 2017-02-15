<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxusercompany
 *
 * @ORM\Table(name="website_styxusercompany")
 * @ORM\Entity
 */
class WebsiteStyxusercompany
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


}
