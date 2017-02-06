<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostPromocode
 *
 * @ORM\Table(name="post_promocode")
 * @ORM\Entity
 */
class PostPromocode
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_unique", type="boolean", nullable=false)
     */
    private $isUnique;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code;

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
     * Set isUnique
     *
     * @param boolean $isUnique
     * @return PostPromocode
     */
    public function setIsUnique($isUnique)
    {
        $this->isUnique = $isUnique;

        return $this;
    }

    /**
     * Get isUnique
     *
     * @return boolean 
     */
    public function getIsUnique()
    {
        return $this->isUnique;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return PostPromocode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set postPtr
     *
     * @param \coreBundle\Entity\PostPost $postPtr
     * @return PostPromocode
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
