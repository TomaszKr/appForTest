<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cloth;
use AppBundle\Form\ClothType;


class ClothController extends BaseController
{
    public function __construct()
    {
        $this->object = new Cloth();
        $this->formType = ClothType::class;
        $this->groupForSerializer = [\AppBundle\Dictionary\SerializerType::CLOTH];
    }
    
}
