<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebsiteStyxuserstudentFollowing
 *
 * @ORM\Table(name="website_styxuserstudent_following", uniqueConstraints={@ORM\UniqueConstraint(name="website_styxuserstudent_follow_styxuserstudent_id_014cb408_uniq", columns={"styxuserstudent_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="website_styxuserstudent_following_abd26065", columns={"styxuserstudent_id"}), @ORM\Index(name="website_styxuserstudent_following_b694f505", columns={"styxuserbase_id"})})
 * @ORM\Entity
 */
class WebsiteStyxuserstudentFollowing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="website_styxuserstudent_following_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserbase
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserbase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserbase_id", referencedColumnName="id")
     * })
     */
    private $styxuserbase;

    /**
     * @var \coreBundle\Entity\WebsiteStyxuserstudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\WebsiteStyxuserstudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="styxuserstudent_id", referencedColumnName="styxuserbase_ptr_id")
     * })
     */
    private $styxuserstudent;


}
