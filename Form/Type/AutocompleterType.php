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
abstract class AutocompleterType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $transformer = $options['value_transformer'];
        
        if(!$transformer instanceof DataTransformerInterface) {
            throw new FormException('The option "value_transformer" must implement DataTransformerInterface');
        }
        
        $builder->appendClientTransformer($transformer);  
        
        if(!$options['url']) {
            throw new FormException('The option "url" is required.');
        }
        
        $builder->setAttribute('url', $options['url']);
        $builder->setAttribute('must_match', $options['must_match']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
        $view
            ->set('value', $form->getClientData())
            ->set('url', $form->getAttribute('url'))
            ->set('must_match', $form->getAttribute('must_match'));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'url' => null,
            'value_transformer' => new AutocompleterDataTransformer(),
            'must_match' => false
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'field';
    }
}