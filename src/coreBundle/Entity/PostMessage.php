<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostMessage
 *
 * @ORM\Table(name="post_message", indexes={@ORM\Index(name="post_message_d52ac232", columns={"conversation_id"}), @ORM\Index(name="post_message_4f331e2f", columns={"author_id"})})
 * @ORM\Entity
 */
class PostMessage
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
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moderated", type="boolean", nullable=false)
     */
    private $moderated;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_message_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @return PostMessage
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
     * Set message
     *
     * @param string $message
     * @return PostMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PostMessage
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
     * Set moderated
     *
     * @param boolean $moderated
     * @return PostMessage
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set conversation
     *
     * @param \coreBundle\Entity\PostConversation $conversation
     * @return PostMessage
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
     * @return PostMessage
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
