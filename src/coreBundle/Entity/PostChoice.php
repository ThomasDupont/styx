<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostChoice
 *
 * @ORM\Table(name="post_choice", indexes={@ORM\Index(name="post_choice_582e9e5a", columns={"poll_id"})})
 * @ORM\Entity
 */
class PostChoice
{
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=50, nullable=false)
     */
    private $label;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=false)
     */
    private $coefficient;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_choice_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \coreBundle\Entity\PostPoll
     *
     * @ORM\ManyToOne(targetEntity="coreBundle\Entity\PostPoll")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="poll_id", referencedColumnName="post_ptr_id")
     * })
     */
    private $poll;



    /**
     * Set label
     *
     * @param string $label
     * @return PostChoice
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set coefficient
     *
     * @param integer $coefficient
     * @return PostChoice
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
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
     * Set poll
     *
     * @param \coreBundle\Entity\PostPoll $poll
     * @return PostChoice
     */
    public function setPoll(\coreBundle\Entity\PostPoll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \coreBundle\Entity\PostPoll 
     */
    public function getPoll()
    {
        return $this->poll;
    }
}
