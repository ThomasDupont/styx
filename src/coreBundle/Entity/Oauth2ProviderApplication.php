<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oauth2ProviderApplication
 *
 * @ORM\Table(name="oauth2_provider_application", uniqueConstraints={@ORM\UniqueConstraint(name="oauth2_provider_application_client_id_key", columns={"client_id"})}, indexes={@ORM\Index(name="oauth2_provider_application_client_secret_53133678_like", columns={"client_secret"}), @ORM\Index(name="oauth2_provider_application_client_id_03f0cc84_like", columns={"client_id"}), @ORM\Index(name="oauth2_provider_application_e8701ad4", columns={"user_id"}), @ORM\Index(name="oauth2_provider_application_9d667c2b", columns={"client_secret"})})
 * @ORM\Entity
 */
class Oauth2ProviderApplication
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=100, nullable=false)
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_uris", type="text", nullable=false)
     */
    private $redirectUris;

    /**
     * @var string
     *
     * @ORM\Column(name="client_type", type="string", length=32, nullable=false)
     */
    private $clientType;

    /**
     * @var string
     *
     * @ORM\Column(name="authorization_grant_type", type="string", length=32, nullable=false)
     */
    private $authorizationGrantType;

    /**
     * @var string
     *
     * @ORM\Column(name="client_secret", type="string", length=255, nullable=false)
     */
    private $clientSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skip_authorization", type="boolean", nullable=false)
     */
    private $skipAuthorization;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth2_provider_application_id_seq", allocationSize=1, initialValue=1)
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
     * Set clientId
     *
     * @param string $clientId
     * @return Oauth2ProviderApplication
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set redirectUris
     *
     * @param string $redirectUris
     * @return Oauth2ProviderApplication
     */
    public function setRedirectUris($redirectUris)
    {
        $this->redirectUris = $redirectUris;

        return $this;
    }

    /**
     * Get redirectUris
     *
     * @return string 
     */
    public function getRedirectUris()
    {
        return $this->redirectUris;
    }

    /**
     * Set clientType
     *
     * @param string $clientType
     * @return Oauth2ProviderApplication
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;

        return $this;
    }

    /**
     * Get clientType
     *
     * @return string 
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * Set authorizationGrantType
     *
     * @param string $authorizationGrantType
     * @return Oauth2ProviderApplication
     */
    public function setAuthorizationGrantType($authorizationGrantType)
    {
        $this->authorizationGrantType = $authorizationGrantType;

        return $this;
    }

    /**
     * Get authorizationGrantType
     *
     * @return string 
     */
    public function getAuthorizationGrantType()
    {
        return $this->authorizationGrantType;
    }

    /**
     * Set clientSecret
     *
     * @param string $clientSecret
     * @return Oauth2ProviderApplication
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Get clientSecret
     *
     * @return string 
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Oauth2ProviderApplication
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
     * Set skipAuthorization
     *
     * @param boolean $skipAuthorization
     * @return Oauth2ProviderApplication
     */
    public function setSkipAuthorization($skipAuthorization)
    {
        $this->skipAuthorization = $skipAuthorization;

        return $this;
    }

    /**
     * Get skipAuthorization
     *
     * @return boolean 
     */
    public function getSkipAuthorization()
    {
        return $this->skipAuthorization;
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
     * @return Oauth2ProviderApplication
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
