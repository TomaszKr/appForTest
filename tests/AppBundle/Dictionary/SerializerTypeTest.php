<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerializerTypeTest
 *
 * @author tomasz
 */
class SerializerTypeTest
{
    public function dictionaryTest()
    {        
         $this->assertEquals('cloth', AppBundle\Dictionary\SerializerType::CLOTH);
         $this->assertEquals('groupCloth', AppBundle\Dictionary\SerializerType::GROUP_CLOTH);
         $this->assertEquals('unitMeasure', AppBundle\Dictionary\SerializerType::UNIT_MEASURE);
         $this->assertEquals('tree', AppBundle\Dictionary\SerializerType::TREE);
    }
}
