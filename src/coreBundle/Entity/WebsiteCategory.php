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
     *   @ORM\JoinColumn(name="parentType_id, referencedColumnName="id")
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


}
