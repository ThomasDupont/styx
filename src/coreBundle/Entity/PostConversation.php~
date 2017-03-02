<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostConversation
 *
 * @ORM\Table(name="post_conversation", indexes={@ORM\Index(name="post_conversation_f3aa1999", columns={"post_id"})})
 * @ORM\Entity
 */
class PostConversation
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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_conversation_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * Set identifier
     *
     * @param string $identifier
     * @return PostConversation
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
     * @return PostConversation
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set post
     *
     * @param \coreBundle\Entity\PostPost $post
     * @return PostConversation
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
}
