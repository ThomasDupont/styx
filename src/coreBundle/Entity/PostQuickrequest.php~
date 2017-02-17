<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostQuickrequest
 *
 * @ORM\Table(name="post_quickrequest", indexes={@ORM\Index(name="post_quickrequest_b583a629", columns={"category_id"})})
 * @ORM\Entity
 */
class PostQuickrequest
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=300, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="datetimetz", nullable=false)
     */
    private $expiration;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_participant", type="integer", nullable=false)
     */
    private $maxParticipant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_quickrequest_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteCategory
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;



    /**
     * Set title
     *
     * @param string $title
     * @return PostQuickrequest
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PostQuickrequest
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set expiration
     *
     * @param \DateTime $expiration
     * @return PostQuickrequest
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * Get expiration
     *
     * @return \DateTime 
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return PostQuickrequest
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set maxParticipant
     *
     * @param integer $maxParticipant
     * @return PostQuickrequest
     */
    public function setMaxParticipant($maxParticipant)
    {
        $this->maxParticipant = $maxParticipant;

        return $this;
    }

    /**
     * Get maxParticipant
     *
     * @return integer 
     */
    public function getMaxParticipant()
    {
        return $this->maxParticipant;
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
     * Set category
     *
     * @param \coreBundle\Entity\WebsiteCategory $category
     * @return PostQuickrequest
     */
    public function setCategory(\coreBundle\Entity\WebsiteCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \coreBundle\Entity\WebsiteCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
