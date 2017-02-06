<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostEvent
 *
 * @ORM\Table(name="post_event")
 * @ORM\Entity
 */
class PostEvent
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour", type="time", nullable=false)
     */
    private $hour;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=144, nullable=false)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=100, nullable=true)
     */
    private $avatar;

    /**
     * @var \coreBundle\Entity\PostPost
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="coreBundle\Entity\PostPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_ptr_id", referencedColumnName="id")
     * })
     */
    private $postPtr;



    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PostEvent
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hour
     *
     * @param \DateTime $hour
     * @return PostEvent
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return \DateTime 
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return PostEvent
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return PostEvent
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set postPtr
     *
     * @param \coreBundle\Entity\PostPost $postPtr
     * @return PostEvent
     */
    public function setPostPtr(\coreBundle\Entity\PostPost $postPtr)
    {
        $this->postPtr = $postPtr;

        return $this;
    }

    /**
     * Get postPtr
     *
     * @return \coreBundle\Entity\PostPost 
     */
    public function getPostPtr()
    {
        return $this->postPtr;
    }
}
