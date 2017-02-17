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



    /**
     * Set video
     *
     * @param string $video
     * @return WebsiteGame
     */
    public function setVideo($video)
    {
        $this->video = $video;
    
        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return WebsiteGame
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    
        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean 
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     * @return WebsiteGame
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    
        return $this;
    }

    /**
     * Get vote
     *
     * @return integer 
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WebsiteGame
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
}
