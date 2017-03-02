<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostRequeststudent
 *
 * @ORM\Table(name="post_requeststudent")
 * @ORM\Entity
 */
class PostRequeststudent
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean", nullable=false)
     */
    private $closed;

    /**
     * @var integer
     *
     * @ORM\Column(name="rewards", type="integer", nullable=false)
     */
    private $rewards;

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
     * Set closed
     *
     * @param boolean $closed
     * @return PostRequeststudent
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean 
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set rewards
     *
     * @param integer $rewards
     * @return PostRequeststudent
     */
    public function setRewards($rewards)
    {
        $this->rewards = $rewards;

        return $this;
    }

    /**
     * Get rewards
     *
     * @return integer 
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * Set postPtr
     *
     * @param \coreBundle\Entity\PostPost $postPtr
     * @return PostRequeststudent
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
