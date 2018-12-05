<?php
namespace AppBundle\Controller;

use AppBundle\Entity\UnitMeasure;
use AppBundle\Form\UnitMeasureType;

/**
 * Zarządzanie danymi związanymi z obiektem UnitMeasure
 */
class UnitMeasureController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $this->object = new UnitMeasure();
        $this->formType = UnitMeasureType::class;
        $this->groupForSerializer = [\AppBundle\Dictionary\SerializerType::UNIT_MEASURE];
    }
}
