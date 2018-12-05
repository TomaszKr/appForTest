<?php
namespace AppBundle\Controller;

use AppBundle\Entity\GroupCloth;
use AppBundle\Form\GroupClothType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Zarządzanie danymi związanymi z obiektem GroupCloth
 */
class GroupClothController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();
        $this->object = new GroupCloth();
        $this->formType = GroupClothType::class;
        $this->groupForSerializer = [\AppBundle\Dictionary\SerializerType::GROUP_CLOTH];
    }

    /**
     * Wyświetlenie grupy elementów
     * 
     * @param Request $request
     * @param int $id
     * @param string $type
     * @return JsonResponse
     */
    public function tree(Request $request, $id, $type)
    {
        $groupCloth = $this->getDoctrine()->getRepository(get_class($this->object))->find($id);

        if (!$groupCloth) {
            return new JsonResponse(array('error' => 'Not found object'), Response::HTTP_NOT_ACCEPTABLE);
        }

        $json = $this->serialize($groupCloth, [$this->typeStrategy($type)]);

        return new JsonResponse(array('action' => 'tree', 'data' => $json), Response::HTTP_OK);
    }

    /**
     * Strategia dla odpowiedniego typu serializacji danych
     * 
     * @param string $type
     * @return JsonResponse
     */
    private function typeStrategy($type)
    {
        switch ($type) {
            case 'show':
                return \AppBundle\Dictionary\SerializerType::TREE;
                break;
            case 'get':
                return \AppBundle\Dictionary\SerializerType::GROUP_CLOTH;
                break;
            default:
                return new JsonResponse(array('error' => 'Not found object'), Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
