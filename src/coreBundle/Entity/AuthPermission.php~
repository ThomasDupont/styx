<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthPermission
 *
 * @ORM\Table(name="auth_permission", uniqueConstraints={@ORM\UniqueConstraint(name="auth_permission_content_type_id_01ab375a_uniq", columns={"content_type_id", "codename"})}, indexes={@ORM\Index(name="auth_permission_417f1b1c", columns={"content_type_id"})})
 * @ORM\Entity
 */
class AuthPermission
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="codename", type="string", length=100, nullable=false)
     */
    private $codename;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="auth_permission_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\DjangoContentType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\DjangoContentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="content_type_id", referencedColumnName="id")
     * })
     */
    private $contentType;



    /**
     * Set name
     *
     * @param string $name
     * @return AuthPermission
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
     * Set codename
     *
     * @param string $codename
     * @return AuthPermission
     */
    public function setCodename($codename)
    {
        $this->codename = $codename;

        return $this;
    }

    /**
     * Get codename
     *
     * @return string 
     */
    public function getCodename()
    {
        return $this->codename;
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
     * Set contentType
     *
     * @param \coreBundle\Entity\DjangoContentType $contentType
     * @return AuthPermission
     */
    public function setContentType(\coreBundle\Entity\DjangoContentType $contentType = null)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return \coreBundle\Entity\DjangoContentType 
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}
