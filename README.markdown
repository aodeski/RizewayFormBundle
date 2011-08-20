RizewayFormBundle - Extra Form Types for Symfony2
=================================================

The ``RizewayFormBundle`` offers new Form Types for your Symfony2 Project

 - rizeway_autocompleter
 - rizeway_jqueryui_autocompleter
 - rizeway_xoxco_autocompleter

Installation
------------

### Add the bundle to your src directory
    git submodule add git://github.com/youknowriad/RizewayFormBundle.git src/Rizeway/FormBundle

### Register the Rizeway namespace
    // app/autoload.php
    $loader->registerNamespaces(array(
        'Rizeway' => __DIR__.'/../src',
        // Other namespaces
    ));

### Add the bundle to your Kernel
    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Rizeway\FormBundle\RizewayFormBundle(),
            // ...
        );
    }

Rizeway Autocompleter Types
--------------------------
These types allow you to add autocomplete fields that accept multiple values (Example: tags)

### How to use it ?

    $builder->add('tags', 'rizeway_jqueryui_autocompleter', array(
        'url' => '/tags/get',
    ));

or

    $builder->add('tags', 'rizeway_xoxco_autocompleter', array(
        'url' => '/tags/get',
    ));

or

    $builder->add('tags', 'rizeway_autocompleter', array(
        'url' => '/tags/get',
        'must_match' => true
    ));

the ``rizeway_jqueryui_autocompleter`` type is based on the [jQueryUI Autocomplete Widget](http://jqueryui.com/demos/autocomplete/)

the ``rizeway_xoxco_autocompleter`` type is based on the [Xoxco jQuery Tags Input Widget](http://xoxco.com/clickable/jquery-tags-input)

### Options
The type have a ``value_transformer`` option. By default, the dataTransformer used
transforms the input values separated by ',' to an array of values.

You can write your own transform for example to get an ArrayCollection of Entities.

