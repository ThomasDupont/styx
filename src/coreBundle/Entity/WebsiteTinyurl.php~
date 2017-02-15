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


}
