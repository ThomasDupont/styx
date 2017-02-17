<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteTinyurl
 *
 * @ORM\Table(name="website_tinyurl")
 * @ORM\Entity
 */
class WebsiteTinyurl
{
    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=300, nullable=false)
     */
    private $link;

    /**
     * @var integer
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_tinyurl_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set link
     *
     * @param string $link
     * @return WebsiteTinyurl
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     * @return WebsiteTinyurl
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    
        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
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
}
