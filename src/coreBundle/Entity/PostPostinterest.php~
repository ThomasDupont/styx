<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostPostinterest
 *
 * @ORM\Table(name="post_postinterest", indexes={@ORM\Index(name="post_postinterest_f3aa1999", columns={"post_id"}), @ORM\Index(name="post_postinterest_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class PostPostinterest
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_first_view", type="datetimetz", nullable=false)
     */
    private $dateFirstView;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_last_view", type="datetimetz", nullable=false)
     */
    private $dateLastView;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_views", type="integer", nullable=false)
     */
    private $countViews;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_postinterest_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\PostPost
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;



    /**
     * Set dateFirstView
     *
     * @param \DateTime $dateFirstView
     * @return PostPostinterest
     */
    public function setDateFirstView($dateFirstView)
    {
        $this->dateFirstView = $dateFirstView;

        return $this;
    }

    /**
     * Get dateFirstView
     *
     * @return \DateTime 
     */
    public function getDateFirstView()
    {
        return $this->dateFirstView;
    }

    /**
     * Set dateLastView
     *
     * @param \DateTime $dateLastView
     * @return PostPostinterest
     */
    public function setDateLastView($dateLastView)
    {
        $this->dateLastView = $dateLastView;

        return $this;
    }

    /**
     * Get dateLastView
     *
     * @return \DateTime 
     */
    public function getDateLastView()
    {
        return $this->dateLastView;
    }

    /**
     * Set countViews
     *
     * @param integer $countViews
     * @return PostPostinterest
     */
    public function setCountViews($countViews)
    {
        $this->countViews = $countViews;

        return $this;
    }

    /**
     * Get countViews
     *
     * @return integer 
     */
    public function getCountViews()
    {
        return $this->countViews;
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
     * @return PostPostinterest
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
     * Set post
     *
     * @param \coreBundle\Entity\PostPost $post
     * @return PostPostinterest
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
