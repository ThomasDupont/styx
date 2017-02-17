<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteLoguseraction
 *
 * @ORM\Table(name="website_loguseraction", indexes={@ORM\Index(name="website_loguseraction_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class WebsiteLoguseraction
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1000, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=300, nullable=true)
     */
    private $browser;

    /**
     * @var string
     *
     * @ORM\Column(name="browser_version", type="string", length=300, nullable=true)
     */
    private $browserVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=300, nullable=true)
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="os_version", type="string", length=300, nullable=true)
     */
    private $osVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="device", type="string", length=300, nullable=true)
     */
    private $device;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_pc", type="boolean", nullable=false)
     */
    private $isPc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_tablet", type="boolean", nullable=false)
     */
    private $isTablet;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_mobile", type="boolean", nullable=false)
     */
    private $isMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=300, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="previous_url", type="string", length=300, nullable=false)
     */
    private $previousUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_loguseraction_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set date
     *
     * @param \DateTime $date
     * @return WebsiteLoguseraction
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return WebsiteLoguseraction
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set browser
     *
     * @param string $browser
     * @return WebsiteLoguseraction
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    
        return $this;
    }

    /**
     * Get browser
     *
     * @return string 
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set browserVersion
     *
     * @param string $browserVersion
     * @return WebsiteLoguseraction
     */
    public function setBrowserVersion($browserVersion)
    {
        $this->browserVersion = $browserVersion;
    
        return $this;
    }

    /**
     * Get browserVersion
     *
     * @return string 
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * Set os
     *
     * @param string $os
     * @return WebsiteLoguseraction
     */
    public function setOs($os)
    {
        $this->os = $os;
    
        return $this;
    }

    /**
     * Get os
     *
     * @return string 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set osVersion
     *
     * @param string $osVersion
     * @return WebsiteLoguseraction
     */
    public function setOsVersion($osVersion)
    {
        $this->osVersion = $osVersion;
    
        return $this;
    }

    /**
     * Get osVersion
     *
     * @return string 
     */
    public function getOsVersion()
    {
        return $this->osVersion;
    }

    /**
     * Set device
     *
     * @param string $device
     * @return WebsiteLoguseraction
     */
    public function setDevice($device)
    {
        $this->device = $device;
    
        return $this;
    }

    /**
     * Get device
     *
     * @return string 
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * Set isPc
     *
     * @param boolean $isPc
     * @return WebsiteLoguseraction
     */
    public function setIsPc($isPc)
    {
        $this->isPc = $isPc;
    
        return $this;
    }

    /**
     * Get isPc
     *
     * @return boolean 
     */
    public function getIsPc()
    {
        return $this->isPc;
    }

    /**
     * Set isTablet
     *
     * @param boolean $isTablet
     * @return WebsiteLoguseraction
     */
    public function setIsTablet($isTablet)
    {
        $this->isTablet = $isTablet;
    
        return $this;
    }

    /**
     * Get isTablet
     *
     * @return boolean 
     */
    public function getIsTablet()
    {
        return $this->isTablet;
    }

    /**
     * Set isMobile
     *
     * @param boolean $isMobile
     * @return WebsiteLoguseraction
     */
    public function setIsMobile($isMobile)
    {
        $this->isMobile = $isMobile;
    
        return $this;
    }

    /**
     * Get isMobile
     *
     * @return boolean 
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return WebsiteLoguseraction
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set previousUrl
     *
     * @param string $previousUrl
     * @return WebsiteLoguseraction
     */
    public function setPreviousUrl($previousUrl)
    {
        $this->previousUrl = $previousUrl;
    
        return $this;
    }

    /**
     * Get previousUrl
     *
     * @return string 
     */
    public function getPreviousUrl()
    {
        return $this->previousUrl;
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
     * @param \coreBundle\Entity\WebsiteStyxuserbase $user
     * @return WebsiteLoguseraction
     */
    public function setUser(\coreBundle\Entity\WebsiteStyxuserbase $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getUser()
    {
        return $this->user;
    }
}
