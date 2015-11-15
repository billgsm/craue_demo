<?php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class CreateTaskFlow extends FormFlow
{
    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType)
    {
        $this->formType = $formType;
    }

    public function getName()
    {
        return 'createTask';
    }

    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'step un',
                'form_type' => $this->formType,
            ),
            array(
                'label' => 'step deux',
                'form_type' => $this->formType,
            ),
        );
    }
}