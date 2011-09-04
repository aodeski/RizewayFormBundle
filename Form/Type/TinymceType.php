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
 * AutocompleterType
 *
 * @author Riad Benguella 
 */
class TinymceType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {   
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'textarea';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rizeway_tinymce';
    }
}