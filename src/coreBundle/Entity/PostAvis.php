<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostAvis
 *
 * @ORM\Table(name="post_avis", indexes={@ORM\Index(name="post_avis_8b938c66", columns={"recipient_id"}), @ORM\Index(name="post_avis_d52ac232", columns={"conversation_id"}), @ORM\Index(name="post_avis_4f331e2f", columns={"author_id"})})
 * @ORM\Entity
 */
class PostAvis
{
    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=32, nullable=false)
     */
    private $identifier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_avis_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipient_id", referencedColumnName="id")
     * })
     */
    private $recipient;

    /**
     * @var \coreBundle\Entity\PostConversation
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostConversation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="conversation_id", referencedColumnName="id")
     * })
     */
    private $conversation;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;



    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostAvis
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostAvis
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
     * Set note
     *
     * @param integer $note
     * @return PostAvis
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return PostAvis
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recipient
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $recipient
     * @return PostAvis
     */
    public function setRecipient(\coreBundle\Entity\WebsiteStyxuserbase $recipient = null)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set conversation
     *
     * @param \coreBundle\Entity\PostConversation $conversation
     * @return PostAvis
     */
    public function setConversation(\coreBundle\Entity\PostConversation $conversation = null)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \coreBundle\Entity\PostConversation 
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set author
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $author
     * @return PostAvis
     */
    public function setAuthor(\coreBundle\Entity\WebsiteStyxuserbase $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
