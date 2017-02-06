<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DjangoMigrations
 *
 * @ORM\Table(name="django_migrations")
 * @ORM\Entity
 */
class DjangoMigrations
{
    /**
     * @var string
     *
     * @ORM\Column(name="app", type="string", length=255, nullable=false)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="applied", type="datetimetz", nullable=false)
     */
    private $applied;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="django_migrations_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set app
     *
     * @param string $app
     * @return DjangoMigrations
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return string 
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DjangoMigrations
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
     * Set applied
     *
     * @param \DateTime $applied
     * @return DjangoMigrations
     */
    public function setApplied($applied)
    {
        $this->applied = $applied;

        return $this;
    }

    /**
     * Get applied
     *
     * @return \DateTime 
     */
    public function getApplied()
    {
        return $this->applied;
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
