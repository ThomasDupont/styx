<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use coreBundle\Entity\WebsiteGroup;

/**
 * WebsiteStyxuserbase
 *
 * @ORM\Table(name="website_styxuserbase", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserbase_email_key", columns={"email"})}, indexes={@ORM\Index(name="website_styxuserbase_0e939a4f", columns={"group_id"}), @ORM\Index(name="website_styxuserbase_email_4d007222_like", columns={"email"})})
 * @ORM\Entity
 */
class WebsiteStyxuserbase
{

  // public function __construct($group) {
  //   $this->id = 1;
  //   $this->password = "password";
  //   $this->identifier = "identifier1";
  //   $this->createdAt = "2016-02-15 15:15:15+02";
  //   $this->email = "jeanjjj@daz.fr";
  //   $this->name = "yay";
  //   $this->emailConfirmed = true;
  //   $this->isAdmin = true;
  //   $this->group = $group;
  // }

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetimetz", nullable=true)
     */
    private $lastLogin;

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
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserbase_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteGroup
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

    public function getGroup() {
      return $this->group;
    }

    public function getId() {
      return $this->id;
    }

    public function getName() {
      return $this->name;
    }
}
