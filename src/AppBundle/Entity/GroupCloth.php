<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GroupCloth
 *
 * @ORM\Table(name="group_cloth")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupClothRepository")
 */
class GroupCloth
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var GroupCloth 
     * 
     * @ORM\OneToMany(targetEntity="GroupCloth", mappedBy="parent")
     */
    private $children;
    
    /**
     * @var GroupCloth
     *
     * @ORM\ManyToOne(targetEntity="GroupCloth", inversedBy="children") 
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;
    
    /**
     * @var GroupCloth
     *
     * @ORM\OneToMany(targetEntity="Cloth", mappedBy="groupCloth") 
     */
    private $cloths;

    
    public function __construct() {
        $this->cloths = new ArrayCollection();
        $this->children = new ArrayCollection();
    }
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return GroupCloth
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param GroupCloth $parent
     *
     * @return GroupCloth
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return GroupCloth
     */
    public function getParent()
    {
        return $this->parent;
    }
}

