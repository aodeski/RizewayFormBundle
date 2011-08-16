<?php

namespace Rizeway\FormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Add a new twig form ressource
 *
 * @author Riad Benguella
 */
class FormPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $resources = $container->getParameter('twig.form.resources');
        $resources[] = 'RizewayFormBundle:Form:fields.html.twig';

        $container->setParameter('twig.form.resources', $resources);
    }
}