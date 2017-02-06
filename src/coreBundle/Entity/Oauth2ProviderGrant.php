<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oauth2ProviderGrant
 *
 * @ORM\Table(name="oauth2_provider_grant", indexes={@ORM\Index(name="oauth2_provider_grant_code_49ab4ddf_like", columns={"code"}), @ORM\Index(name="oauth2_provider_grant_6bc0a4eb", columns={"application_id"}), @ORM\Index(name="oauth2_provider_grant_e8701ad4", columns={"user_id"}), @ORM\Index(name="oauth2_provider_grant_c1336794", columns={"code"})})
 * @ORM\Entity
 */
class Oauth2ProviderGrant
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetimetz", nullable=false)
     */
    private $expires;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_uri", type="string", length=255, nullable=false)
     */
    private $redirectUri;

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="text", nullable=false)
     */
    private $scope;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth2_provider_grant_id_seq", allocationSize=1, initialValue=1)
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
     * Set code
     *
     * @param string $code
     * @return Oauth2ProviderGrant
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     * @return Oauth2ProviderGrant
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime 
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set redirectUri
     *
     * @param string $redirectUri
     * @return Oauth2ProviderGrant
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * Get redirectUri
     *
     * @return string 
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return Oauth2ProviderGrant
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string 
     */
    public function getScope()
    {
        return $this->scope;
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
     * @return Oauth2ProviderGrant
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
     * @return Oauth2ProviderGrant
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
}
