<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteSocial
 *
 * @ORM\Table(name="website_social", indexes={@ORM\Index(name="website_social_dffc4713", columns={"entity_id"})})
 * @ORM\Entity
 */
class WebsiteSocial
{
    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=200, nullable=false)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=200, nullable=false)
     */
    private $youtube;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=200, nullable=false)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=200, nullable=false)
     */
    private $facebook;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_social_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     * })
     */
    private $entity;


}
