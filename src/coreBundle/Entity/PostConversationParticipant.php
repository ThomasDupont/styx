<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostConversationParticipant
 *
 * @ORM\Table(name="post_conversation_participant", uniqueConstraints={@ORM\UniqueConstraint(name="post_conversation_participant_conversation_id_d0f1a02f_uniq", columns={"conversation_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="post_conversation_participant_b694f505", columns={"styxuserbase_id"}), @ORM\Index(name="post_conversation_participant_d52ac232", columns={"conversation_id"})})
 * @ORM\Entity
 */
class PostConversationParticipant
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_conversation_participant_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserbase_id", referencedColumnName="id")
     * })
     */
    private $styxuserbase;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set styxuserbase
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbase
     * @return PostConversationParticipant
     */
    public function setStyxuserbase(\coreBundle\Entity\WebsiteStyxuserbase $styxuserbase = null)
    {
        $this->styxuserbase = $styxuserbase;

        return $this;
    }

    /**
     * Get styxuserbase
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getStyxuserbase()
    {
        return $this->styxuserbase;
    }

    /**
     * Set conversation
     *
     * @param \coreBundle\Entity\PostConversation $conversation
     * @return PostConversationParticipant
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
}
