<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity\Testy;

use AppBundle\Entity\GroupCloth;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Description of Cloth
 *
 * @author tomasz
 */
class GroupClothTest extends TestCase
{

    public function testObject()
    {
        $name = 'Nazwa';
        $children = new GroupCloth();
        $parent = new GroupCloth();

        $groupCloth = new GroupCloth();

        $this->assertInstanceOf(GroupCloth::class, $groupCloth->setName($name));
        $this->assertInstanceOf(GroupCloth::class, $groupCloth->setChildren($children));
        $this->assertInstanceOf(GroupCloth::class, $groupCloth->setParent($parent));

        $this->assertEquals($name, $groupCloth->getName());
        $this->assertEquals($children, $groupCloth->getChildren());
        $this->assertEquals($parent, $groupCloth->getParent());
    }
}
