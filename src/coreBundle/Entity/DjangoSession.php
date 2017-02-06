<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DjangoSession
 *
 * @ORM\Table(name="django_session", indexes={@ORM\Index(name="django_session_session_key_c0390e0f_like", columns={"session_key"}), @ORM\Index(name="django_session_de54fa62", columns={"expire_date"})})
 * @ORM\Entity
 */
class DjangoSession
{
    /**
     * @var string
     *
     * @ORM\Column(name="session_data", type="text", nullable=false)
     */
    private $sessionData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetimetz", nullable=false)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="session_key", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="django_session_session_key_seq", allocationSize=1, initialValue=1)
     */
    private $sessionKey;



    /**
     * Set sessionData
     *
     * @param string $sessionData
     * @return DjangoSession
     */
    public function setSessionData($sessionData)
    {
        $this->sessionData = $sessionData;

        return $this;
    }

    /**
     * Get sessionData
     *
     * @return string 
     */
    public function getSessionData()
    {
        return $this->sessionData;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return DjangoSession
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;

        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime 
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Get sessionKey
     *
     * @return string 
     */
    public function getSessionKey()
    {
        return $this->sessionKey;
    }
}
