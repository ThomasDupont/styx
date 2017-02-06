<?php

namespace coreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DjangoContentType
 *
 * @ORM\Table(name="django_content_type", uniqueConstraints={@ORM\UniqueConstraint(name="django_content_type_app_label_76bd3d3b_uniq", columns={"app_label", "model"})})
 * @ORM\Entity
 */
class DjangoContentType
{
    /**
     * @var string
     *
     * @ORM\Column(name="app_label", type="string", length=100, nullable=false)
     */
    private $appLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=100, nullable=false)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="django_content_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set appLabel
     *
     * @param string $appLabel
     * @return DjangoContentType
     */
    public function setAppLabel($appLabel)
    {
        $this->appLabel = $appLabel;

        return $this;
    }

    /**
     * Get appLabel
     *
     * @return string 
     */
    public function getAppLabel()
    {
        return $this->appLabel;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return DjangoContentType
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
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
