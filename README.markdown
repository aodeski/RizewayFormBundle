RizewayFormBundle - Extra Form Types for Symfony2
=================================================

The ``RizewayFormBundle`` offers new Form Types for your Symfony2 Project
 - rizeway_autocompleter

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

Rizeway Autocompleter Type
--------------------------
This type allow you to add autocomplete fields that accept multiple values (Example: tags)

### Who to use it ?
    $builder->add('tags', 'rizeway_tinymce', array(
        'url' => '/tags/get',
    ));

### Options
The type have a ``value_transformer`` option. By default, the dataTransformer used
transforms the input values separated by ',' to an array of values.

You can write your own transform for example to get an ArrayCollection of Entities.

More information
----------------

This bundle is based on the JqueryUIAutocompleter Widget, you need to install the
assets to make it work.

TODO
----

 - allow personal configuration of the jQueryUI plugin, (like simple values, choices ...)