<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostPostZones
 *
 * @ORM\Table(name="post_post_zones", uniqueConstraints={@ORM\UniqueConstraint(name="post_post_zones_post_id_59480896_uniq", columns={"post_id", "zone_id"})}, indexes={@ORM\Index(name="post_post_zones_06342dd7", columns={"zone_id"}), @ORM\Index(name="post_post_zones_f3aa1999", columns={"post_id"})})
 * @ORM\Entity
 */
class PostPostZones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_post_zones_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteZone
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteZone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     * })
     */
    private $zone;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set zone
     *
     * @param \coreBundle\Entity\WebsiteZone $zone
     * @return PostPostZones
     */
    public function setZone(\coreBundle\Entity\WebsiteZone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \coreBundle\Entity\WebsiteZone 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set post
     *
     * @param \coreBundle\Entity\PostPost $post
     * @return PostPostZones
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
