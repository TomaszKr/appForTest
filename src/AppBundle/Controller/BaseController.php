<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller;

use AppBundle\Errors\ErrorForms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of BaseController
 *
 * @author tomasz
 */
class BaseController extends Controller
{

    /**
     * Klasy Entity  
     * 
     * 
     */
    protected $object;

    /**
     *  Typ formularza dla klas Entity
     * 
     * @var AbstractType 
     */
    protected $formType;

    /**
     * Tablica grupy do serializacji
     * 
     * @see \AppBundle\Dictionary\SerializerType
     * 
     * @var array 
     */
    protected $groupForSerializer;

    /**
     * Wartości domyśle
     */
    public function __construct()
    {
        $this->object = null;
        $this->formType = null;
        $this->groupForSerializer = [];
    }

    /**
     * Dodanie nowych danych do bazy
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {

        $form = $this->createForm($this->formType, $this->object);
        $form->submit($request->request->all(), false);

        $violationList = $this->get('validator')->validate($this->object);

        if ($form->isValid() && 1 > $violationList->count()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($this->object);
            $entityManager->flush();

            $json = $this->serialize($this->object, $this->groupForSerializer);

            return new JsonResponse(array('action' => 'created', 'data' => $json), Response::HTTP_CREATED);
        }

        $errors = new ErrorForms();

        return new JsonResponse(array('error' => $errors->showError($form)), Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * Modyfikacja instniejacych danych w bazie
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $object = $this->getDoctrine()->getRepository(get_class($this->object))->find($request->request->get('id'));

        if (!$object) {
            return new JsonResponse(array('error' => 'Not found object'), Response::HTTP_NOT_ACCEPTABLE);
        }

        $form = $this->createForm($this->formType, $object);
        $request->request->remove('id');
        $form->submit($request->request->all(), false);

        $violationList = $this->get('validator')->validate($object);

        if ($form->isValid() && 1 > $violationList->count()) {

            $entityManager->persist($object);
            $entityManager->flush();

            $json = $this->serialize($object, $this->groupForSerializer);

            return new JsonResponse(array('action' => 'update', 'data' => $json), Response::HTTP_OK);
        }

        $errors = new ErrorForms();

        return new JsonResponse(array('error' => $errors->showError($form)), Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * Serializacja danych
     * 
     * @see ../Resources/config/serialization/serialization.yml
     * 
     * @param type $object klasy znajdujące się w Entity
     * @param array $groups
     * @return JSON
     */
    protected function serialize($object, array $groups)
    {
        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__ . '/../Resources/config/serialization/serialization.yml'));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer(array($normalizer));
        return $serializer->normalize($object, null, array('groups' => $groups, 'skip_null_values' => true, 'enable_max_depth' => true));
    }
}
