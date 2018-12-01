<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UnitMeasure;
use AppBundle\Form\UnitMeasureType;

class UnitMeasureController extends BaseController
{
    
    public function __construct()
    {
        $this->object = new UnitMeasure();
        $this->formType = UnitMeasureType::class;
    }
    
}
