<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteGame
 *
 * @ORM\Table(name="website_game")
 * @ORM\Entity
 */
class WebsiteGame
{
    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=500, nullable=false)
     */
    private $video;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean", nullable=true)
     */
    private $activated;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote", type="integer", nullable=true)
     */
    private $vote;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=32, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_game_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


}
