<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Thread as BaseThread;

/**
 * @ORM\Entity
 */
class MessageThread extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="message_thread_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $createdBy;

    /**
     * @ORM\OneToMany(
     *   targetEntity="coreBundle\Entity\MessageMessage",
     *   mappedBy="thread",
     *   cascade={"all"}
     * )
     * @var Message[]|Collection
     */
    protected $messages;

    /**
     * @ORM\OneToMany(
     *   targetEntity="coreBundle\Entity\MessageThreadMetadata",
     *   mappedBy="thread",
     *   cascade={"all"}
     * )
     * @var ThreadMetadata[]|Collection
     */
    protected $metadata;
}
