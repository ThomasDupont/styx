<?php

namespace coreBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use websiteBundle\Controller\FeedController;

/**
 * PostPost
 *
 * @ORM\Table(name="post_post", indexes={@ORM\Index(name="post_post_b583a629", columns={"category_id"}), @ORM\Index(name="post_post_5e7b1936", columns={"owner_id"})})
 * @ORM\Entity(repositoryClass="PostPostRepository")
 */
class PostPost
{
    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=32, nullable=false)
     */
    private $identifier;

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
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postponed_at", type="datetimetz", nullable=true)
     */
    private $postponedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_comment", type="boolean", nullable=false)
     */
    private $hasComment = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moderated", type="boolean", nullable=false)
     */
    private $moderated = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_at", type="datetimetz", nullable=true)
     */
    private $editedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_post_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     * })
     */
    private $owner;

    /**
     * @var \coreBundle\Entity\WebsiteZone
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteZone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id" nullable=false)
     * })
     */
    private $zone;

    /**
     * @var \coreBundle\Entity\WebsiteCategory
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;


    public function __construct()
    {
        $string = str_split(Uuid::uuid4()->toString());
        foreach($string as &$char)
            $char = "".dechex(ord($char));
        $this->identifier = substr(implode('',$string), 0, 32);
        $this->createdAt = new DateTime();
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostPost
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return PostPost
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
     * @return PostPost
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set postponedAt
     *
     * @param \DateTime $postponedAt
     * @return PostPost
     */
    public function setPostponedAt($postponedAt)
    {
        $this->postponedAt = $postponedAt;

        return $this;
    }

    /**
     * Get postponedAt
     *
     * @return \DateTime
     */
    public function getPostponedAt()
    {
        return $this->postponedAt;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return PostPost
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
     * Set hasComment
     *
     * @param boolean $hasComment
     * @return PostPost
     */
    public function setHasComment($hasComment)
    {
        $this->hasComment = $hasComment;

        return $this;
    }

    /**
     * Get hasComment
     *
     * @return boolean
     */
    public function getHasComment()
    {
        return $this->hasComment;
    }

    /**
     * Set moderated
     *
     * @param boolean $moderated
     * @return PostPost
     */
    public function setModerated($moderated)
    {
        $this->moderated = $moderated;

        return $this;
    }

    /**
     * Get moderated
     *
     * @return boolean
     */
    public function getModerated()
    {
        return $this->moderated;
    }

    /**
     * Set editedAt
     *
     * @param \DateTime $editedAt
     * @return PostPost
     */
    public function setEditedAt($editedAt)
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    /**
     * Get editedAt
     *
     * @return \DateTime
     */
    public function getEditedAt()
    {
        return $this->editedAt;
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
     * Set owner
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $owner
     * @return PostPost
     */
    public function setOwner(\coreBundle\Entity\WebsiteStyxuserbase $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set category
     *
     * @param \coreBundle\Entity\WebsiteCategory $category
     * @return PostPost
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
