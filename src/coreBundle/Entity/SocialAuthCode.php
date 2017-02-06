<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialAuthCode
 *
 * @ORM\Table(name="social_auth_code", uniqueConstraints={@ORM\UniqueConstraint(name="social_auth_code_email_801b2d02_uniq", columns={"email", "code"})}, indexes={@ORM\Index(name="social_auth_code_c1336794", columns={"code"}), @ORM\Index(name="social_auth_code_code_a2393167_like", columns={"code"})})
 * @ORM\Entity
 */
class SocialAuthCode
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=254, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32, nullable=false)
     */
    private $code;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean", nullable=false)
     */
    private $verified;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="social_auth_code_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set email
     *
     * @param string $email
     * @return SocialAuthCode
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
     * Set code
     *
     * @param string $code
     * @return SocialAuthCode
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
     * Set verified
     *
     * @param boolean $verified
     * @return SocialAuthCode
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean 
     */
    public function getVerified()
    {
        return $this->verified;
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
