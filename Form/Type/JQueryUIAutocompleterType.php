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
class JQueryUIAutocompleterType extends AbstractType
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
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
        $view
            ->set('value', $form->getClientData())
            ->set('url', $form->getAttribute('url'));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'url' => null,
            'value_transformer' => new AutocompleterDataTransformer() 
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'field';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rizeway_autocompleter';
    }
}