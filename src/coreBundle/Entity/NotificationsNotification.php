<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationsNotification
 *
 * @ORM\Table(name="notifications_notification", indexes={@ORM\Index(name="notifications_notification_e4f9dcc7", columns={"target_content_type_id"}), @ORM\Index(name="notifications_notification_142874d9", columns={"action_object_content_type_id"}), @ORM\Index(name="notifications_notification_8b938c66", columns={"recipient_id"}), @ORM\Index(name="notifications_notification_53a09d9a", columns={"actor_content_type_id"})})
 * @ORM\Entity
 */
class NotificationsNotification
{
    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=20, nullable=false)
     */
    private $level;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unread", type="boolean", nullable=false)
     */
    private $unread;

    /**
     * @var string
     *
     * @ORM\Column(name="actor_object_id", type="string", length=255, nullable=false)
     */
    private $actorObjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="verb", type="string", length=255, nullable=false)
     */
    private $verb;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="target_object_id", type="string", length=255, nullable=true)
     */
    private $targetObjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="action_object_object_id", type="string", length=255, nullable=true)
     */
    private $actionObjectObjectId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz", nullable=false)
     */
    private $timestamp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean", nullable=false)
     */
    private $public;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailed", type="boolean", nullable=false)
     */
    private $emailed;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="notifications_notification_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\DjangoContentType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\DjangoContentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_content_type_id", referencedColumnName="id")
     * })
     */
    private $targetContentType;

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
     * @var \coreBundle\Entity\DjangoContentType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\DjangoContentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actor_content_type_id", referencedColumnName="id")
     * })
     */
    private $actorContentType;

    /**
     * @var \coreBundle\Entity\DjangoContentType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\DjangoContentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_object_content_type_id", referencedColumnName="id")
     * })
     */
    private $actionObjectContentType;



    /**
     * Set level
     *
     * @param string $level
     * @return NotificationsNotification
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set unread
     *
     * @param boolean $unread
     * @return NotificationsNotification
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;

        return $this;
    }

    /**
     * Get unread
     *
     * @return boolean 
     */
    public function getUnread()
    {
        return $this->unread;
    }

    /**
     * Set actorObjectId
     *
     * @param string $actorObjectId
     * @return NotificationsNotification
     */
    public function setActorObjectId($actorObjectId)
    {
        $this->actorObjectId = $actorObjectId;

        return $this;
    }

    /**
     * Get actorObjectId
     *
     * @return string 
     */
    public function getActorObjectId()
    {
        return $this->actorObjectId;
    }

    /**
     * Set verb
     *
     * @param string $verb
     * @return NotificationsNotification
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;

        return $this;
    }

    /**
     * Get verb
     *
     * @return string 
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return NotificationsNotification
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
     * Set targetObjectId
     *
     * @param string $targetObjectId
     * @return NotificationsNotification
     */
    public function setTargetObjectId($targetObjectId)
    {
        $this->targetObjectId = $targetObjectId;

        return $this;
    }

    /**
     * Get targetObjectId
     *
     * @return string 
     */
    public function getTargetObjectId()
    {
        return $this->targetObjectId;
    }

    /**
     * Set actionObjectObjectId
     *
     * @param string $actionObjectObjectId
     * @return NotificationsNotification
     */
    public function setActionObjectObjectId($actionObjectObjectId)
    {
        $this->actionObjectObjectId = $actionObjectObjectId;

        return $this;
    }

    /**
     * Get actionObjectObjectId
     *
     * @return string 
     */
    public function getActionObjectObjectId()
    {
        return $this->actionObjectObjectId;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return NotificationsNotification
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return NotificationsNotification
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean 
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return NotificationsNotification
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
     * Set emailed
     *
     * @param boolean $emailed
     * @return NotificationsNotification
     */
    public function setEmailed($emailed)
    {
        $this->emailed = $emailed;

        return $this;
    }

    /**
     * Get emailed
     *
     * @return boolean 
     */
    public function getEmailed()
    {
        return $this->emailed;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return NotificationsNotification
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
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
     * Set targetContentType
     *
     * @param \coreBundle\Entity\DjangoContentType $targetContentType
     * @return NotificationsNotification
     */
    public function setTargetContentType(\coreBundle\Entity\DjangoContentType $targetContentType = null)
    {
        $this->targetContentType = $targetContentType;

        return $this;
    }

    /**
     * Get targetContentType
     *
     * @return \coreBundle\Entity\DjangoContentType 
     */
    public function getTargetContentType()
    {
        return $this->targetContentType;
    }

    /**
     * Set recipient
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $recipient
     * @return NotificationsNotification
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
     * Set actorContentType
     *
     * @param \coreBundle\Entity\DjangoContentType $actorContentType
     * @return NotificationsNotification
     */
    public function setActorContentType(\coreBundle\Entity\DjangoContentType $actorContentType = null)
    {
        $this->actorContentType = $actorContentType;

        return $this;
    }

    /**
     * Get actorContentType
     *
     * @return \coreBundle\Entity\DjangoContentType 
     */
    public function getActorContentType()
    {
        return $this->actorContentType;
    }

    /**
     * Set actionObjectContentType
     *
     * @param \coreBundle\Entity\DjangoContentType $actionObjectContentType
     * @return NotificationsNotification
     */
    public function setActionObjectContentType(\coreBundle\Entity\DjangoContentType $actionObjectContentType = null)
    {
        $this->actionObjectContentType = $actionObjectContentType;

        return $this;
    }

    /**
     * Get actionObjectContentType
     *
     * @return \coreBundle\Entity\DjangoContentType 
     */
    public function getActionObjectContentType()
    {
        return $this->actionObjectContentType;
    }
}
