<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteMember
 *
 * @ORM\Table(name="website_member", indexes={@ORM\Index(name="website_member_e8701ad4", columns={"user_id"}), @ORM\Index(name="website_member_dffc4713", columns={"entity_id"})})
 * @ORM\Entity
 */
class WebsiteMember
{
    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, nullable=false)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=40, nullable=false)
     */
    private $userName;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_member_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     * })
     */
    private $entity;



    /**
     * Set role
     *
     * @param string $role
     * @return WebsiteMember
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return WebsiteMember
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    
        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
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
     * @return WebsiteMember
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
     * Set entity
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $entity
     * @return WebsiteMember
     */
    public function setEntity(\coreBundle\Entity\WebsiteStyxuserbase $entity = null)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
