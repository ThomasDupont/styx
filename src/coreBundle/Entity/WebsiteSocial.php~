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



    /**
     * Set website
     *
     * @param string $website
     * @return WebsiteSocial
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     * @return WebsiteSocial
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    
        return $this;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return WebsiteSocial
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    
        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return WebsiteSocial
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    
        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
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
     * Set entity
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $entity
     * @return WebsiteSocial
     */
    public function setEntity(\coreBundle\Entity\WebsiteStyxuserbase $entity = null)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
