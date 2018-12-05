<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Klasa jednostka miary
 * 
 * @ORM\Table(name="unit_measure")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnitMeasureRepository")
 * 
 * @UniqueEntity(
 *     fields="name",
 *     errorPath="name",
 *     message="This name is already in use."
 * )
 * @UniqueEntity(
 *     fields="shortName",
 *     errorPath="shortName",
 *     message="This shortName is already in use." 
 * ) 
 */
class UnitMeasure
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
     * @var string
     * 
     * @Assert\NotBlank 
     * 
     * @ORM\Column(name="shortName", type="string", length=255, unique=true)
     */
    private $shortName;

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
     * @return UnitMeasure
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
     * Set shortName
     *
     * @param string $shortName
     *
     * @return UnitMeasure
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }
}
