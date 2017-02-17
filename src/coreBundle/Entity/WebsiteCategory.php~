<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteCategory
 *
 * @ORM\Table(name="website_category", indexes={@ORM\Index(name="website_category_6e181f88", columns={"parentType_id"}), @ORM\Index(name="website_category_6be37982", columns={"parent_id"})})
 * @ORM\Entity
 */
class WebsiteCategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="nameCategory", type="string", length=45, nullable=false)
     */
    private $namecategory;

    /**
     * @var string
     *
     * @ORM\Column(name="nameSkill", type="string", length=45, nullable=false)
     */
    private $nameskill;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentType_id", type="integer", nullable=false)
     */
    private $parenttypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_category_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteType
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentType_id", referencedColumnName="id")
     * })
     */
    private $parenttype;

    /**
     * @var \coreBundle\Entity\WebsiteCategory
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @return string
     */
    public function getNamecategory()
    {
        return $this->namecategory;
    }



    /**
     * Set namecategory
     *
     * @param string $namecategory
     * @return WebsiteCategory
     */
    public function setNamecategory($namecategory)
    {
        $this->namecategory = $namecategory;
    
        return $this;
    }

    /**
     * Set nameskill
     *
     * @param string $nameskill
     * @return WebsiteCategory
     */
    public function setNameskill($nameskill)
    {
        $this->nameskill = $nameskill;
    
        return $this;
    }

    /**
     * Get nameskill
     *
     * @return string 
     */
    public function getNameskill()
    {
        return $this->nameskill;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return WebsiteCategory
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set parenttypeId
     *
     * @param integer $parenttypeId
     * @return WebsiteCategory
     */
    public function setParenttypeId($parenttypeId)
    {
        $this->parenttypeId = $parenttypeId;
    
        return $this;
    }

    /**
     * Get parenttypeId
     *
     * @return integer 
     */
    public function getParenttypeId()
    {
        return $this->parenttypeId;
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
     * Set parenttype
     *
     * @param \coreBundle\Entity\WebsiteType $parenttype
     * @return WebsiteCategory
     */
    public function setParenttype(\coreBundle\Entity\WebsiteType $parenttype = null)
    {
        $this->parenttype = $parenttype;
    
        return $this;
    }

    /**
     * Get parenttype
     *
     * @return \coreBundle\Entity\WebsiteType 
     */
    public function getParenttype()
    {
        return $this->parenttype;
    }

    /**
     * Set parent
     *
     * @param \coreBundle\Entity\WebsiteCategory $parent
     * @return WebsiteCategory
     */
    public function setParent(\coreBundle\Entity\WebsiteCategory $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \coreBundle\Entity\WebsiteCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
