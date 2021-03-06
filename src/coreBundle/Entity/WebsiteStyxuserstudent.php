<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserstudent
 *
 * @ORM\Table(name="website_styxuserstudent", indexes={@ORM\Index(name="website_styxuserstudent_28883a1b", columns={"sponsorship_id"}), @ORM\Index(name="website_styxuserstudent_5fc7164b", columns={"school_id"})})
 * @ORM\Entity
 */
class WebsiteStyxuserstudent
{
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=false)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_notification", type="boolean", nullable=false)
     */
    private $emailNotification;

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
     * @var \coreBundle\Entity\WebsiteSchool
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteSchool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * })
     */
    private $school;


}
