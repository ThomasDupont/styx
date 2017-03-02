<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostChoiceUsers
 *
 * @ORM\Table(name="post_choice_users", uniqueConstraints={@ORM\UniqueConstraint(name="post_choice_users_choice_id_826a20f6_uniq", columns={"choice_id", "styxuserstudent_id"})}, indexes={@ORM\Index(name="post_choice_users_428bb064", columns={"choice_id"}), @ORM\Index(name="post_choice_users_abd26065", columns={"styxuserstudent_id"})})
 * @ORM\Entity
 */
class PostChoiceUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_choice_users_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \coreBundle\Entity\PostChoice
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostChoice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="choice_id", referencedColumnName="id")
     * })
     */
    private $choice;



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
     * Set styxuserstudent
     *
     * @param \coreBundle\Entity\WebsiteStyxuserstudent $styxuserstudent
     * @return PostChoiceUsers
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

    /**
     * Set choice
     *
     * @param \coreBundle\Entity\PostChoice $choice
     * @return PostChoiceUsers
     */
    public function setChoice(\coreBundle\Entity\PostChoice $choice = null)
    {
        $this->choice = $choice;

        return $this;
    }

    /**
     * Get choice
     *
     * @return \coreBundle\Entity\PostChoice 
     */
    public function getChoice()
    {
        return $this->choice;
    }
}
