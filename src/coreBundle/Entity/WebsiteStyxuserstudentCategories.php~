<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserstudentCategories
 *
 * @ORM\Table(name="website_styxuserstudent_categories", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserstudent_catego_styxuserstudent_id_756823bd_uniq", columns={"styxuserstudent_id", "category_id"})}, indexes={@ORM\Index(name="website_styxuserstudent_categories_b583a629", columns={"category_id"}), @ORM\Index(name="website_styxuserstudent_categories_abd26065", columns={"styxuserstudent_id"})})
 * @ORM\Entity
 */
class WebsiteStyxuserstudentCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserstudent_categories_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteCategory
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserstudent_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $styxuserstudent;



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
     * Set category
     *
     * @param \coreBundle\Entity\WebsiteCategory $category
     * @return WebsiteStyxuserstudentCategories
     */
    public function setCategory(\coreBundle\Entity\WebsiteCategory $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \coreBundle\Entity\WebsiteCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set styxuserstudent
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent
     * @return WebsiteStyxuserstudentCategories
     */
    public function setStyxuserstudent(\coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent = null)
    {
        $this->styxuserstudent = $styxuserstudent;
    
        return $this;
    }

    /**
     * Get styxuserstudent
     *
     * @return \coreBundle\Entity\WebsiteStyxuserstudent 
     */
    public function getStyxuserstudent()
    {
        return $this->styxuserstudent;
    }
}
