<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostNews
 *
 * @ORM\Table(name="post_news")
 * @ORM\Entity
 */
class PostNews
{
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
     * Set postPtr
     *
     * @param \coreBundle\Entity\PostPost $postPtr
     * @return PostNews
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
