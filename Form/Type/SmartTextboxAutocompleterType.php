<?php

namespace Rizeway\FormBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\DataTransformerInterface;

use Rizeway\FormBundle\Form\DataTransform\AutocompleterDataTransformer;

/**
 * JQueryAutocompleterType
 *
 * @author Riad Benguella 
 */
class SmartTextboxAutocompleterType extends AutocompleterType
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rizeway_smarttextbox_autocompleter';
    }
}