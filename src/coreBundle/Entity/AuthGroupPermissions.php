<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthGroupPermissions
 *
 * @ORM\Table(name="auth_group_permissions", uniqueConstraints={@ORM\UniqueConstraint(name="auth_group_permissions_group_id_0cd325b0_uniq", columns={"group_id", "permission_id"})}, indexes={@ORM\Index(name="auth_group_permissions_8373b171", columns={"permission_id"}), @ORM\Index(name="auth_group_permissions_0e939a4f", columns={"group_id"})})
 * @ORM\Entity
 */
class AuthGroupPermissions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="auth_group_permissions_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\AuthPermission
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\AuthPermission")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     * })
     */
    private $permission;

    /**
     * @var \coreBundle\Entity\AuthGroup
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\AuthGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;



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
     * Set permission
     *
     * @param \coreBundle\Entity\AuthPermission $permission
     * @return AuthGroupPermissions
     */
    public function setPermission(\coreBundle\Entity\AuthPermission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return \coreBundle\Entity\AuthPermission 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set group
     *
     * @param \coreBundle\Entity\AuthGroup $group
     * @return AuthGroupPermissions
     */
    public function setGroup(\coreBundle\Entity\AuthGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \coreBundle\Entity\AuthGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
