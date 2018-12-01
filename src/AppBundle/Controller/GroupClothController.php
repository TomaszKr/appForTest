<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GroupCloth;
use AppBundle\Form\GroupClothType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupClothController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->object = new GroupCloth();
        $this->formType = GroupClothType::class;
        $this->groupForSerializer = [\AppBundle\Dictionary\SerializerType::GROUP_CLOTH];
    }

    public function tree(Request $request, $id)
    {
        $groupCloth = $this->getDoctrine()->getRepository(get_class($this->object))->find($id);
        
        if(!$groupCloth){
            return new JsonResponse(array('error'=>'Not found object'),Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $json = $this->serialize($groupCloth, [\AppBundle\Dictionary\SerializerType::TREE]);
        
        return new JsonResponse(array('action'=>'tree','data'=>$json),Response::HTTP_NOT_ACCEPTABLE);
    }
    
}
