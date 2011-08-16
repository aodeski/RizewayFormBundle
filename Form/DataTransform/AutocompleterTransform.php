<?php

namespace Rizeway\FormBundle\Form\DataTransform;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Transform the value of the autocompleter Type
 *
 * @author Riad Benguella
 */
class AutocompleterDataTransformer implements DataTransformerInterface
{
    
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (\is_null($value)) {
            return '';
        }
        
        if (!\is_array($value)) {
            throw new UnexpectedTypeException($value, 'array');
        }
        
        return \implode( ', ', $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        $results = array();
        $values = \explode(',', $value);
        foreach ($values as $val) {
            if (!empty(\trim($val))) {
                $results[] = $val;
            }
        }
        
        return $results;
    }
}