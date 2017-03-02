<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteTemporaryuser
 *
 * @ORM\Table(name="website_temporaryuser", uniqueConstraints={@ORM\UniqueConstraint(name="website_temporaryuser_email_key", columns={"email"})}, indexes={@ORM\Index(name="website_temporaryuser_e8701ad4", columns={"user_id"}), @ORM\Index(name="website_temporaryuser_06342dd7", columns={"zone_id"}), @ORM\Index(name="website_temporaryuser_email_d1899624_like", columns={"email"})})
 * @ORM\Entity
 */
class WebsiteTemporaryuser
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convert", type="boolean", nullable=false)
     */
    private $convert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_temporaryuser_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $user;

    /**
     * @var \coreBundle\Entity\WebsiteZone
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteZone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     * })
     */
    private $zone;



    /**
     * Set email
     *
     * @param string $email
     * @return WebsiteTemporaryuser
     */
    public function setEmail($email)
    {
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
     * Set password
     *
     * @param string $password
     * @return WebsiteTemporaryuser
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set convert
     *
     * @param boolean $convert
     * @return WebsiteTemporaryuser
     */
    public function setConvert($convert)
    {
        $this->convert = $convert;
    
        return $this;
    }

    /**
     * Get convert
     *
     * @return boolean 
     */
    public function getConvert()
    {
        return $this->convert;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return WebsiteTemporaryuser
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $user
     * @return WebsiteTemporaryuser
     */
    public function setUser(\coreBundle\Entity\WebsiteStyxuserstudent $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \coreBundle\Entity\WebsiteStyxuserstudent 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set zone
     *
     * @param \coreBundle\Entity\WebsiteZone $zone
     * @return WebsiteTemporaryuser
     */
    public function setZone(\coreBundle\Entity\WebsiteZone $zone = null)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return \coreBundle\Entity\WebsiteZone 
     */
    public function getZone()
    {
        return $this->zone;
    }
}
