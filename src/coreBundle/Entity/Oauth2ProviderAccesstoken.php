<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oauth2ProviderAccesstoken
 *
 * @ORM\Table(name="oauth2_provider_accesstoken", indexes={@ORM\Index(name="oauth2_provider_accesstoken_token_8af090f8_like", columns={"token"}), @ORM\Index(name="oauth2_provider_accesstoken_6bc0a4eb", columns={"application_id"}), @ORM\Index(name="oauth2_provider_accesstoken_94a08da1", columns={"token"}), @ORM\Index(name="oauth2_provider_accesstoken_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class Oauth2ProviderAccesstoken
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetimetz", nullable=false)
     */
    private $expires;

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
     * @ORM\SequenceGenerator(sequenceName="oauth2_provider_accesstoken_id_seq", allocationSize=1, initialValue=1)
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
     * Set token
     *
     * @param string $token
     * @return Oauth2ProviderAccesstoken
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
     * Set expires
     *
     * @param \DateTime $expires
     * @return Oauth2ProviderAccesstoken
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
     * Set scope
     *
     * @param string $scope
     * @return Oauth2ProviderAccesstoken
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
     * @return Oauth2ProviderAccesstoken
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
     * @return Oauth2ProviderAccesstoken
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
