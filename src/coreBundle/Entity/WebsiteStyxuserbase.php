<?php

namespace coreBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use coreBundle\Entity\WebsiteGroup;
use FOS\UserBundle\Entity\User as BaseUser;
use Ramsey\Uuid\Uuid;

/**
 * WebsiteStyxuserbase
 *
 * @ORM\Table(name="website_styxuserbase", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserbase_email_key", columns={"email"})}, indexes={@ORM\Index(name="website_styxuserbase_0e939a4f", columns={"group_id"}), @ORM\Index(name="website_styxuserbase_email_4d007222_like", columns={"email"})})
 * @ORM\Entity(repositoryClass="WebsiteStyxuserbaseRepository")
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_notification", type="boolean", nullable=false)
     */
    private $emailNotification = true;

    /**
     * @var \coreBundle\Entity\WebsiteZone
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteZone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $city;

    /**
     * @var \coreBundle\Entity\WebsiteSchool
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteSchool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=5, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var boolean
     *
     * @ORM\Column(name="email_confirmed", type="boolean", nullable=false)
     */
    private $emailConfirmed = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_admin", type="boolean", nullable=false)
     */
    private $isAdmin = false;

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
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $group;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new DateTime();
        $string = str_split(Uuid::uuid4()->toString());
        foreach($string as &$char)
            $char = "".dechex(ord($char));
        $this->identifier = substr(implode('',$string), 0, 32);
        $this->username = 'username';
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return WebsiteStyxuserbase
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return WebsiteStyxuserbase
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return WebsiteStyxuserbase
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set emailNotification
     *
     * @param boolean $emailNotification
     * @return WebsiteStyxuserbase
     */
    public function setEmailNotification($emailNotification)
    {
        $this->emailNotification = $emailNotification;

        return $this;
    }

    /**
     * Get emailNotification
     *
     * @return boolean
     */
    public function getEmailNotification()
    {
        return $this->emailNotification;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return WebsiteStyxuserbase
     */
    public function setEmail($email)
    {
        // $email = is_null($email) ? '' : $email;
        // parent::setEmail($email);
        $this->setUsername($email);
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return WebsiteStyxuserbase
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return WebsiteStyxuserbase
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return WebsiteStyxuserbase
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WebsiteStyxuserbase
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return WebsiteStyxuserbase
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return WebsiteStyxuserbase
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set emailConfirmed
     *
     * @param boolean $emailConfirmed
     * @return WebsiteStyxuserbase
     */
    public function setEmailConfirmed($emailConfirmed)
    {
        $this->emailConfirmed = $emailConfirmed;

        return $this;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return WebsiteStyxuserbase
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get emailConfirmed
     *
     * @return boolean
     */
    public function getEmailConfirmed()
    {
        return $this->emailConfirmed;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     * @return WebsiteStyxuserbase
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return WebsiteStyxuserbase
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set group
     *
     * @param \coreBundle\Entity\WebsiteGroup $group
     * @return WebsiteStyxuserbase
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \coreBundle\Entity\WebsiteGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set school
     *
     * @param \coreBundle\Entity\WebsiteSchool $school
     * @return WebsiteStyxuserbase
     */
    public function setSchool(\coreBundle\Entity\WebsiteSchool $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \coreBundle\Entity\WebsiteSchool
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set school
     *
     * @param \coreBundle\Entity\WebsiteZone $city
     * @return WebsiteStyxuserbase
     */
    public function setCity(\coreBundle\Entity\WebsiteZone $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \coreBundle\Entity\WebsiteZone
     */
    public function getCity()
    {
        return $this->city;
    }

}