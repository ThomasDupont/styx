<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostRequeststudentParticipants
 *
 * @ORM\Table(name="post_requeststudent_participants", uniqueConstraints={@ORM\UniqueConstraint(name="post_requeststudent_participant_requeststudent_id_2f9619bd_uniq", columns={"requeststudent_id", "styxuserbase_id"})}, indexes={@ORM\Index(name="post_requeststudent_participants_b694f505", columns={"styxuserbase_id"}), @ORM\Index(name="post_requeststudent_participants_ad66a0b5", columns={"requeststudent_id"})})
 * @ORM\Entity
 */
class PostRequeststudentParticipants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_requeststudent_participants_id_seq", allocationSize=1, initialValue=1)
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
     * @var \coreBundle\Entity\PostRequeststudent
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostRequeststudent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="requeststudent_id", referencedColumnName="post_ptr_id")
     * })
     */
    private $requeststudent;



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
     * Set styxuserbase
     *
     * @param \coreBundle\Entity\WebsiteStyxuserbase $styxuserbase
     * @return PostRequeststudentParticipants
     */
    public function setStyxuserbase(\coreBundle\Entity\WebsiteStyxuserbase $styxuserbase = null)
    {
        $this->styxuserbase = $styxuserbase;

        return $this;
    }

    /**
     * Get styxuserbase
     *
     * @return \coreBundle\Entity\WebsiteStyxuserbase 
     */
    public function getStyxuserbase()
    {
        return $this->styxuserbase;
    }

    /**
     * Set requeststudent
     *
     * @param \coreBundle\Entity\PostRequeststudent $requeststudent
     * @return PostRequeststudentParticipants
     */
    public function setRequeststudent(\coreBundle\Entity\PostRequeststudent $requeststudent = null)
    {
        $this->requeststudent = $requeststudent;

        return $this;
    }

    /**
     * Get requeststudent
     *
     * @return \coreBundle\Entity\PostRequeststudent 
     */
    public function getRequeststudent()
    {
        return $this->requeststudent;
    }
}
