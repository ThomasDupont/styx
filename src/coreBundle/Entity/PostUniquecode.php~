<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostUniquecode
 *
 * @ORM\Table(name="post_uniquecode", indexes={@ORM\Index(name="post_uniquecode_0b5d9da0", columns={"promo_code_id"}), @ORM\Index(name="post_uniquecode_e8701ad4", columns={"user_id"})})
 * @ORM\Entity
 */
class PostUniquecode
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_uniquecode_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\PostPromocode
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostPromocode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_code_id", referencedColumnName="post_ptr_id")
     * })
     */
    private $promoCode;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $user;



    /**
     * Set code
     *
     * @param string $code
     * @return PostUniquecode
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set promoCode
     *
     * @param \coreBundle\Entity\PostPromocode $promoCode
     * @return PostUniquecode
     */
    public function setPromoCode(\coreBundle\Entity\PostPromocode $promoCode = null)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return \coreBundle\Entity\PostPromocode 
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set user
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $user
     * @return PostUniquecode
     */
    public function setUser(\coreBundle\Entity\WebsiteStyxuserstudent $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \coreBundle\Entity\WebsiteStyxuserstudent 
     */
    public function getUser()
    {
        return $this->user;
    }
}
