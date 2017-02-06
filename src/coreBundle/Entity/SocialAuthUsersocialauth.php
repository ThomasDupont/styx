<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialAuthUsersocialauth
 *
 * @ORM\Table(name="social_auth_usersocialauth", uniqueConstraints={@ORM\UniqueConstraint(name="social_auth_usersocialauth_provider_e6b5e668_uniq", columns={"provider", "uid"})}, indexes={@ORM\Index(name="social_auth_usersocialauth_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class SocialAuthUsersocialauth
{
    /**
     * @var string
     *
     * @ORM\Column(name="provider", type="string", length=32, nullable=false)
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="uid", type="string", length=255, nullable=false)
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="extra_data", type="text", nullable=false)
     */
    private $extraData;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="social_auth_usersocialauth_id_seq", allocationSize=1, initialValue=1)
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
     * Set provider
     *
     * @param string $provider
     * @return SocialAuthUsersocialauth
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string 
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set uid
     *
     * @param string $uid
     * @return SocialAuthUsersocialauth
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return string 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set extraData
     *
     * @param string $extraData
     * @return SocialAuthUsersocialauth
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    /**
     * Get extraData
     *
     * @return string 
     */
    public function getExtraData()
    {
        return $this->extraData;
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
     * @return SocialAuthUsersocialauth
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
