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


}
