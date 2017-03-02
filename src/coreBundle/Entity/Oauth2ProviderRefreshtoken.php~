<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oauth2ProviderRefreshtoken
 *
 * @ORM\Table(name="oauth2_provider_refreshtoken", uniqueConstraints={@ORM\UniqueConstraint(name="oauth2_provider_refreshtoken_access_token_id_key", columns={"access_token_id"})}, indexes={@ORM\Index(name="oauth2_provider_refreshtoken_94a08da1", columns={"token"}), @ORM\Index(name="oauth2_provider_refreshtoken_6bc0a4eb", columns={"application_id"}), @ORM\Index(name="oauth2_provider_refreshtoken_token_d090daa4_like", columns={"token"}), @ORM\Index(name="oauth2_provider_refreshtoken_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class Oauth2ProviderRefreshtoken
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth2_provider_refreshtoken_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\Oauth2ProviderApplication
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\Oauth2ProviderApplication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="application_id", referencedColumnName="id")
     * })
     */
    private $application;

    /**
     * @var \coreBundle\Entity\Oauth2ProviderAccesstoken
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\Oauth2ProviderAccesstoken")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="access_token_id", referencedColumnName="id")
     * })
     */
    private $accessToken;



    /**
     * Set token
     *
     * @param string $token
     * @return Oauth2ProviderRefreshtoken
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
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
     * @return Oauth2ProviderRefreshtoken
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

    /**
     * Set application
     *
     * @param \coreBundle\Entity\Oauth2ProviderApplication $application
     * @return Oauth2ProviderRefreshtoken
     */
    public function setApplication(\coreBundle\Entity\Oauth2ProviderApplication $application = null)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get application
     *
     * @return \coreBundle\Entity\Oauth2ProviderApplication 
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Set accessToken
     *
     * @param \coreBundle\Entity\Oauth2ProviderAccesstoken $accessToken
     * @return Oauth2ProviderRefreshtoken
     */
    public function setAccessToken(\coreBundle\Entity\Oauth2ProviderAccesstoken $accessToken = null)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return \coreBundle\Entity\Oauth2ProviderAccesstoken 
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
