<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteDepartment
 *
 * @ORM\Table(name="website_department")
 * @ORM\Entity(repositoryClass="coreBundle\Repository\WebsiteDepartmentRepository")
 */
class WebsiteDepartment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;


    /**
     * Set name
     *
     * @param string $name
     * @return WebsiteDepartment
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
     * Set code
     *
     * @param string $code
     * @return WebsiteDepartment
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
}
