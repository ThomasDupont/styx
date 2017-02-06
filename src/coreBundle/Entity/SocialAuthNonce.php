<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialAuthNonce
 *
 * @ORM\Table(name="social_auth_nonce", uniqueConstraints={@ORM\UniqueConstraint(name="social_auth_nonce_server_url_f6284463_uniq", columns={"server_url", "timestamp", "salt"})})
 * @ORM\Entity
 */
class SocialAuthNonce
{
    /**
     * @var string
     *
     * @ORM\Column(name="server_url", type="string", length=255, nullable=false)
     */
    private $serverUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=65, nullable=false)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="social_auth_nonce_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set serverUrl
     *
     * @param string $serverUrl
     * @return SocialAuthNonce
     */
    public function setServerUrl($serverUrl)
    {
        $this->serverUrl = $serverUrl;

        return $this;
    }

    /**
     * Get serverUrl
     *
     * @return string 
     */
    public function getServerUrl()
    {
        return $this->serverUrl;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return SocialAuthNonce
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return SocialAuthNonce
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
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
}
