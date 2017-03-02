<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DjangoAdminLog
 *
 * @ORM\Table(name="django_admin_log", indexes={@ORM\Index(name="django_admin_log_e8701ad4", columns={"user_id"}), @ORM\Index(name="django_admin_log_417f1b1c", columns={"content_type_id"})})
 * @ORM\Entity
 */
class DjangoAdminLog
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="action_time", type="datetimetz", nullable=false)
     */
    private $actionTime;

    /**
     * @var string
     *
     * @ORM\Column(name="object_id", type="text", nullable=true)
     */
    private $objectId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_repr", type="string", length=200, nullable=false)
     */
    private $objectRepr;

    /**
     * @var integer
     *
     * @ORM\Column(name="action_flag", type="smallint", nullable=false)
     */
    private $actionFlag;

    /**
     * @var string
     *
     * @ORM\Column(name="change_message", type="text", nullable=false)
     */
    private $changeMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="django_admin_log_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\DjangoContentType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\DjangoContentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="content_type_id", referencedColumnName="id")
     * })
     */
    private $contentType;



    /**
     * Set actionTime
     *
     * @param \DateTime $actionTime
     * @return DjangoAdminLog
     */
    public function setActionTime($actionTime)
    {
        $this->actionTime = $actionTime;

        return $this;
    }

    /**
     * Get actionTime
     *
     * @return \DateTime 
     */
    public function getActionTime()
    {
        return $this->actionTime;
    }

    /**
     * Set objectId
     *
     * @param string $objectId
     * @return DjangoAdminLog
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return string 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set objectRepr
     *
     * @param string $objectRepr
     * @return DjangoAdminLog
     */
    public function setObjectRepr($objectRepr)
    {
        $this->objectRepr = $objectRepr;

        return $this;
    }

    /**
     * Get objectRepr
     *
     * @return string 
     */
    public function getObjectRepr()
    {
        return $this->objectRepr;
    }

    /**
     * Set actionFlag
     *
     * @param integer $actionFlag
     * @return DjangoAdminLog
     */
    public function setActionFlag($actionFlag)
    {
        $this->actionFlag = $actionFlag;

        return $this;
    }

    /**
     * Get actionFlag
     *
     * @return integer 
     */
    public function getActionFlag()
    {
        return $this->actionFlag;
    }

    /**
     * Set changeMessage
     *
     * @param string $changeMessage
     * @return DjangoAdminLog
     */
    public function setChangeMessage($changeMessage)
    {
        $this->changeMessage = $changeMessage;

        return $this;
    }

    /**
     * Get changeMessage
     *
     * @return string 
     */
    public function getChangeMessage()
    {
        return $this->changeMessage;
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
     * @return DjangoAdminLog
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
     * Set contentType
     *
     * @param \coreBundle\Entity\DjangoContentType $contentType
     * @return DjangoAdminLog
     */
    public function setContentType(\coreBundle\Entity\DjangoContentType $contentType = null)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return \coreBundle\Entity\DjangoContentType 
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}
