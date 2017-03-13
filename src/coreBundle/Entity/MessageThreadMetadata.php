<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

/**
 * @ORM\Entity
 */
class MessageThreadMetadata extends BaseThreadMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="message_thread_metadata_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="coreBundle\Entity\MessageThread",
     *   inversedBy="metadata"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}