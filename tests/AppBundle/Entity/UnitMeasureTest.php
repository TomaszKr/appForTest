<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity\Testy;

use AppBundle\Entity\UnitMeasure;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Description of Cloth
 *
 * @author tomasz
 */
class UnitMeasureTest extends TestCase
{

    public function testObject()
    {
        $code = 'SK';
        $name = 'Nazwa';

        $unitOfMeasure = new UnitMeasure();

        $this->assertInstanceOf(UnitMeasure::class, $unitOfMeasure->setShortName($code));
        $this->assertInstanceOf(UnitMeasure::class, $unitOfMeasure->setName($name));

        $this->assertEquals(null, $unitOfMeasure->getId());
        $this->assertEquals($code, $unitOfMeasure->getShortName());
        $this->assertEquals($name, $unitOfMeasure->getName());
    }
}
