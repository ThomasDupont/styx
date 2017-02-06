<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteGroup
 *
 * @ORM\Table(name="website_group")
 * @ORM\Entity
 */
class WebsiteGroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="binary_value", type="integer", nullable=false)
     */
    private $binaryValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_group_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


}
