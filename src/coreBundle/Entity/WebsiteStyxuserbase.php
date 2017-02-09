<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * WebsiteStyxuserbase
 *
 * @ORM\Table(name="website_styxuserbase", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserbase_email_key", columns={"email"})}, indexes={@ORM\Index(name="website_styxuserbase_0e939a4f", columns={"group_id"}), @ORM\Index(name="website_styxuserbase_email_4d007222_like", columns={"email"})})
 * @ORM\Entity
 */
class WebsiteStyxuserbase extends BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=32, nullable=false)
     */
    private $identifier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=12, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

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
     * @var \coreBundle\Entity\WebsiteSchool
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteSchool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * })
     */
    private $school;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_notification", type="boolean", nullable=false)
     */
    private $emailNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=128, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=5, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_confirmed", type="boolean", nullable=false)
     */
    private $emailConfirmed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_admin", type="boolean", nullable=false)
     */
    private $isAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=100, nullable=true)
     */
    private $avatar;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserbase_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var \coreBundle\Entity\WebsiteGroup
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->video = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return WebsiteGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return WebsiteSchool
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
