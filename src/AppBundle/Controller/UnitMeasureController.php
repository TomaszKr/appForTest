<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UnitMeasure;
use AppBundle\Form\UnitMeasureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UnitMeasureController extends Controller
{
    public function add(Request $request)
    {
        $unitMeasure = new UnitMeasure();
        $form = $this->createForm(UnitMeasureType::class, $unitMeasure);
        $form->submit($request->request->all(),false);
        
        $violationList = $this->get('validator')->validate($unitMeasure);

        if ($form->isValid() && 1 > $violationList->count()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unitMeasure);
            $entityManager->flush();

            return new JsonResponse(array('status'=>'created'),Response::HTTP_CREATED);
        }
        
        $errors = new \AppBundle\Errors\ErrorForms();
        
        return new JsonResponse(array('error'=>$errors->showError($form)),Response::HTTP_NOT_ACCEPTABLE);
    }
    
    public function edit(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $unitMeasure = $this->getDoctrine()->getRepository(UnitMeasure::class)->find($request->request->get('id'));
        
        if(!$unitMeasure){
            return new JsonResponse(array('error'=>'Not found object'),Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $form = $this->createForm(UnitMeasureType::class, $unitMeasure);
        $request->request->remove('id');
        $form->submit($request->request->all(),false);
        
        $violationList = $this->get('validator')->validate($unitMeasure);
        
        if ($form->isValid() && 1 > $violationList->count()) {
            
            $entityManager->persist($unitMeasure);
            $entityManager->flush();

            return new JsonResponse(array('status'=>'update','name'=>$unitMeasure->getName()),Response::HTTP_CREATED);
        }
        
        $errors = new \AppBundle\Errors\ErrorForms();
        
        return new JsonResponse(array('error'=>$errors->showError($form)),Response::HTTP_NOT_ACCEPTABLE);
    }
    
}
