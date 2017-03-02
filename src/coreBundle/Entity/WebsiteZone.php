<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteZone
 *
 * @ORM\Table(name="website_zone")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="coreBundle\Repository\WebsiteZoneRepository")
 */
class WebsiteZone
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=5, nullable=false)
     */
    private $zipCode;

    /**
    * @var \coreBundle\Entity\WebsiteDepartment
    *
    * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteDepartment")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="department_id", referencedColumnName="id", nullable=false)
    * })
    */
    private $department;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean", nullable=false)
     */
    private $activated;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_zone_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    public function getId() {
      return $this->id;
    }

    public function getZipCode() {
      return $this->zipCode;
    }

    public function getActivated() {
      return $this->activated;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WebsiteZone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return WebsiteZone
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return WebsiteZone
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Set department
     *
     * @param \coreBundle\Entity\WebsiteDepartment $department
     * @return WebsiteZone
     */
    public function setDepartment(\coreBundle\Entity\WebsiteDepartment $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \coreBundle\Entity\WebsiteDepartment
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
    * Get zipcodename
    *
    * @return string
    */
    public function getZipCodeName() {
      return sprintf('%s, %s', $this->zipCode, $this->name);
    }
}
