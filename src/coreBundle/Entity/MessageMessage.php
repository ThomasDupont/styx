<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * @ORM\Entity
 */
class MessageMessage extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="message_message_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\MessageThread", inversedBy="messages")
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(targetEntity="coreBundle\Entity\MessageMessageMetadata", mappedBy="message",cascade={"all"})
     * @var MessageMetadata[]|Collection
     */
    protected $metadata;
}