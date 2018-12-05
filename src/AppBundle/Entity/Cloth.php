<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Klasa Materiał
 *
 * @ORM\Table(name="cloth")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClothRepository")
 * 
 * @UniqueEntity(
 *     fields={"code"},
 *     errorPath="code",
 *     message="This code is already in use."
 * ) 
 */
class Cloth
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
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * 
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var UnitMeasure
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity="UnitMeasure")
     * @ORM\JoinColumn(name="unit_of_measure_id", referencedColumnName="id", nullable=false)
     */
    private $unitOfMeasure;

    /**
     * @var GroupCloth
     *
     * @Assert\NotBlank 
     * 
     * @ORM\ManyToOne(targetEntity="GroupCloth", inversedBy="cloths")
     * @ORM\JoinColumn(name="group_cloth_id", referencedColumnName="id")
     */
    private $groupCloth;

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
     * Set code
     *
     * @param string $code
     *
     * @return Cloth
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Cloth
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
     * Set unitOfMeasure
     *
     * @param UnitMeasure $unitOfMeasure
     *
     * @return Cloth
     */
    public function setUnitOfMeasure(UnitMeasure $unitOfMeasure)
    {
        $this->unitOfMeasure = $unitOfMeasure;

        return $this;
    }

    /**
     * Get unitOfMeasure
     *
     * @return UnitMeasure
     */
    public function getUnitOfMeasure()
    {
        return $this->unitOfMeasure;
    }

    /**
     * Get unitOfMeasure
     *
     * @return GroupCloth
     */
    public function getGroupCloth()
    {
        return $this->groupCloth;
    }

    public function setGroupCloth(GroupCloth $groupCloth)
    {
        $this->groupCloth = $groupCloth;
        return $this;
    }
}
