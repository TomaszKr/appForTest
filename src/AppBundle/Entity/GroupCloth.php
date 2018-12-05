<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Klasa grupa materiałów
 * 
 * @ORM\Table(name="group_cloth")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupClothRepository")
 *
 * @UniqueEntity(
 *     fields={"name"},
 *     errorPath="name",
 *     message="This name is already in use."
 * ) 
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
     * @Assert\NotBlank  
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

    public function __construct()
    {
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

    /**
     * Set parent
     *
     * @param GroupCloth $children
     *
     * @return GroupCloth
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get parent
     *
     * @return GroupCloth
     */
    public function getChildren()
    {
        return $this->children;
    }
}
