<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Cloth;
use AppBundle\Form\ClothType;

/**
 * Zarządzanie danymi związanymi z obiektem Cloth
 */
class ClothController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $this->object = new Cloth();
        $this->formType = ClothType::class;
        $this->groupForSerializer = [\AppBundle\Dictionary\SerializerType::CLOTH];
    }
}
