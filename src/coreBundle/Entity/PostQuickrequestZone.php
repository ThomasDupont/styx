<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostQuickrequestZone
 *
 * @ORM\Table(name="post_quickrequest_zone", uniqueConstraints={@ORM\UniqueConstraint(name="post_quickrequest_zone_quickrequest_id_192dabe5_uniq", columns={"quickrequest_id", "zone_id"})}, indexes={@ORM\Index(name="post_quickrequest_zone_3396e418", columns={"quickrequest_id"}), @ORM\Index(name="post_quickrequest_zone_06342dd7", columns={"zone_id"})})
 * @ORM\Entity
 */
class PostQuickrequestZone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_quickrequest_zone_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\PostQuickrequest
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostQuickrequest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quickrequest_id", referencedColumnName="id")
     * })
     */
    private $quickrequest;



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
     * @return PostQuickrequestZone
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
     * Set quickrequest
     *
     * @param \coreBundle\Entity\PostQuickrequest $quickrequest
     * @return PostQuickrequestZone
     */
    public function setQuickrequest(\coreBundle\Entity\PostQuickrequest $quickrequest = null)
    {
        $this->quickrequest = $quickrequest;

        return $this;
    }

    /**
     * Get quickrequest
     *
     * @return \coreBundle\Entity\PostQuickrequest 
     */
    public function getQuickrequest()
    {
        return $this->quickrequest;
    }
}
