<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller;

use AppBundle\Errors\ErrorForms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of BaseController
 *
 * @author tomasz
 */
class BaseController extends Controller
{
    protected $object;
    protected $formType;
    
    public function __construct()
    {
        $this->object = null;
        $this->formType = null;
    }
    
    public function add(Request $request)
    {
        
        $form = $this->createForm($this->formType, $this->object);
        $form->submit($request->request->all(),false);
        
        $violationList = $this->get('validator')->validate($this->object);
        
        if ($form->isValid() && 1 > $violationList->count()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($this->object);
            $entityManager->flush();

            return new JsonResponse(array('action'=>'created'),Response::HTTP_CREATED);
        }
        
        $errors = new ErrorForms();
        
        return new JsonResponse(array('error'=>$errors->showError($form)),Response::HTTP_NOT_ACCEPTABLE);
    }
    
    public function edit(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $unitMeasure = $this->getDoctrine()->getRepository(get_class($this->object))->find($request->request->get('id'));
        
        if(!$unitMeasure){
            return new JsonResponse(array('error'=>'Not found object'),Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $form = $this->createForm($this->formType, $unitMeasure);
        $request->request->remove('id');
        $form->submit($request->request->all(),false);
        
        $violationList = $this->get('validator')->validate($unitMeasure);
        
        if ($form->isValid() && 1 > $violationList->count()) {
            
            $entityManager->persist($unitMeasure);
            $entityManager->flush();

            return new JsonResponse(array('action'=>'update','name'=>$unitMeasure->getName()),Response::HTTP_CREATED);
        }
        
        $errors = new ErrorForms();
        
        return new JsonResponse(array('error'=>$errors->showError($form)),Response::HTTP_NOT_ACCEPTABLE);
    }
}
