<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GroupCloth;
use AppBundle\Form\GroupClothType;
use Symfony\Component\HttpFoundation\Request;

class GroupClothController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->object = new GroupCloth();
        $this->formType = GroupClothType::class;
    }

    public function tree(Request $request)
    {
        //TODO
    }
}
