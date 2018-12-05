<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity\Testy;

use AppBundle\Entity\Cloth;
use AppBundle\Entity\GroupCloth;
use AppBundle\Entity\UnitMeasure;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Description of Cloth
 *
 * @author tomasz
 */
class ClothTest extends TestCase
{

    public function testObject()
    {
        $code = 'SK';
        $name = 'Nazwa';
        $groupCloth = new GroupCloth();
        $unitOfMeasure = new UnitMeasure();

        $cloth = new Cloth();

        $this->assertInstanceOf(Cloth::class, $cloth->setCode($code));
        $this->assertInstanceOf(Cloth::class, $cloth->setName($name));
        $this->assertInstanceOf(Cloth::class, $cloth->setGroupCloth($groupCloth));
        $this->assertInstanceOf(Cloth::class, $cloth->setUnitOfMeasure($unitOfMeasure));

        $this->assertEquals($code, $cloth->getCode());
        $this->assertEquals($name, $cloth->getName());
        $this->assertEquals($groupCloth, $cloth->getGroupCloth());
        $this->assertEquals($unitOfMeasure, $cloth->getUnitOfMeasure());
    }
}
