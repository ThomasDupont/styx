<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostComment
 *
 * @ORM\Table(name="post_comment", indexes={@ORM\Index(name="post_comment_e8701ad4", columns={"user_id"}), @ORM\Index(name="post_comment_f3aa1999", columns={"post_id"}), @ORM\Index(name="post_comment_4138be47", columns={"father_id"})})
 * @ORM\Entity
 */
class PostComment
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
     * @ORM\Column(name="comment", type="string", length=300, nullable=false)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_at", type="datetimetz", nullable=true)
     */
    private $editedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moderated", type="boolean", nullable=false)
     */
    private $moderated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="quick_answer", type="boolean", nullable=false)
     */
    private $quickAnswer;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_comment_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\PostPost
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;

    /**
     * @var \coreBundle\Entity\PostComment
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostComment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="father_id", referencedColumnName="id")
     * })
     */
    private $father;

    public function __construct()
    {
        //$string = str_split(Uuid::uuid4()->toString());
        $string = uniqid();
        /*foreach($string as &$char)
            $char = "".dechex(ord($char));

        $this->identifier = substr(implode('',$string), 0, 32);
        */
       $this->identifier = $string;
        $this->createdAt = $this->editedAt = new \Datetime();
        $this->deleted = false;
        $this->moderated = false;
        $this->quickAnswer = false;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostComment
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
     * Set comment
     *
     * @param string $comment
     * @return PostComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostComment
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
     * Set editedAt
     *
     * @param \DateTime $editedAt
     * @return PostComment
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
     * Set deleted
     *
     * @param boolean $deleted
     * @return PostComment
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
     * Set moderated
     *
     * @param boolean $moderated
     * @return PostComment
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
     * Set quickAnswer
     *
     * @param boolean $quickAnswer
     * @return PostComment
     */
    public function setQuickAnswer($quickAnswer)
    {
        $this->quickAnswer = $quickAnswer;

        return $this;
    }

    /**
     * Get quickAnswer
     *
     * @return boolean
     */
    public function getQuickAnswer()
    {
        return $this->quickAnswer;
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
     * @return PostComment
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
     * Set post
     *
     * @param \coreBundle\Entity\PostPost $post
     * @return PostComment
     */
    public function setPost(\coreBundle\Entity\PostPost $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \coreBundle\Entity\PostPost
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set father
     *
     * @param \coreBundle\Entity\PostComment $father
     * @return PostComment
     */
    public function setFather(\coreBundle\Entity\PostComment $father = null)
    {
        $this->father = $father;

        return $this;
    }

    /**
     * Get father
     *
     * @return \coreBundle\Entity\PostComment
     */
    public function getFather()
    {
        return $this->father;
    }
}
