<?php

namespace coreBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
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
    private $name = "test";

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=false)
     */
    private $firstname = "test";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

//    /**
//     * @var \coreBundle\Entity\WebsiteSchool
//     *
//     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteSchool")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="school_id", referencedColumnName="id")
//     * })
//     */
    /**
     * @var string
     *
     * @ORM\Column(name="school", type="string", length=255, nullable=false)
     */
    private $school = "test";

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

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
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     * })
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
        $this->createdAt = new DateTime();
        $this->birthday = new DateTime();
        $string = str_split(Uuid::uuid4()->toString());
        foreach($string as &$char)
            $char = "".dechex(ord($char));
        $this->identifier = substr(implode('',$string), 0, 32);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \coreBundle\Entity\WebsiteZone
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
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Set city
     *
     * @param WebsiteZone|string $city
     * @return WebsiteZone
     * @internal param WebsiteZone $id
     */
    public function setCity(\coreBundle\Entity\WebsiteZone $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param string $school
     */
    public function setSchool(string $school)
    {
        $this->school = $school;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }
}
