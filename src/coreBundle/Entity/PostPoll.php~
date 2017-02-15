<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostPoll
 *
 * @ORM\Table(name="post_poll")
 * @ORM\Entity
 */
class PostPoll
{
    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=300, nullable=false)
     */
    private $question;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_answer", type="integer", nullable=false)
     */
    private $maxAnswer;

    /**
     * @var \coreBundle\Entity\PostPost
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="coreBundle\Entity\PostPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_ptr_id", referencedColumnName="id")
     * })
     */
    private $postPtr;



    /**
     * Set question
     *
     * @param string $question
     * @return PostPoll
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set maxAnswer
     *
     * @param integer $maxAnswer
     * @return PostPoll
     */
    public function setMaxAnswer($maxAnswer)
    {
        $this->maxAnswer = $maxAnswer;

        return $this;
    }

    /**
     * Get maxAnswer
     *
     * @return integer 
     */
    public function getMaxAnswer()
    {
        return $this->maxAnswer;
    }

    /**
     * Set postPtr
     *
     * @param \coreBundle\Entity\PostPost $postPtr
     * @return PostPoll
     */
    public function setPostPtr(\coreBundle\Entity\PostPost $postPtr)
    {
        $this->postPtr = $postPtr;

        return $this;
    }

    /**
     * Get postPtr
     *
     * @return \coreBundle\Entity\PostPost 
     */
    public function getPostPtr()
    {
        return $this->postPtr;
    }
}
