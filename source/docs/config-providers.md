---
title: Providers
description: Guide for the providers configuration file
extends: _layouts.documentation
section: content
---
## Providers

WP Headless uses the providers configuration file to instantiate its various classes with their respective dependencies. It also determines the order it creates the objects in.

### Format

```php
    'collection-id' => [
        'container-id' => [
            'class'  => SB2Media\Headless\Example\Example::class,
            'app'    => true,
            'config' => [
                'config-id'
            ],
            'dependencies' => [
                'dependency-container-id'
            ],
            'params' => [
                'param_1',
                'param_2',
                'param_3',
            ]
        ],
    ],
```

The providers array is seperated into collections. Each collection can contain multiple objects and can be queried using the `getCollection()` container method to get an array of container ID's in the collection.

```php
    $collection = app()->getCollection('collection-id');

    var_dump($collection); // ['container-id-1', 'container-id-2', 'container-id-3']
```

The only required parameter is `class`. The other parameters do not need to be included if your class had no dependencies.

The class parameter must be paired with the qualified namespace and class name with the double colon class syntax.

```php
    'class' => Name\Space\Classname::class
```

#### Parameters

Dependencies are broken out into four different categories and must be defined in this order:

1. `app` - boolean - Application container flag
2. `config` - array - Configuration array(s)
3. `dependencies` - array - Class dependencies
4. `params` - array - Other parameter(s)

You may define multuple configs, object dependencies and parameters. Your constructor parameters however must follow this order as well if you write any additional classes for your plugin.

```php
class Example
{
    public function __construct(Plugin $app, array $example_config, ClassOne $object_one, ClassTwo $object_two, $param)
    {
        // constructor code
    }
}
```

```php
    'example-collection' => [
        'example' => [
            'class'  => SB2Media\Headless\Example\Example::class,
            'app'    => true,
            'config' => [
                'example-config'
            ],
            'dependencies' => [
                'object-one',
                'object-two',
            ],
            'params' => [
                'param'
            ]
        ],
    ],
```

##### The Application Container

Many of the classes in the WP Headless library utilize the application container. The container can be passed to any class in your plugin by setting the `app` flag in the provider config.

```php
    'example' => [
        'class' => SB2Media\Headless\Example\Example::class,
        'app' => true
    ],
```

```php
class Example {
    public function __construct(Plugin $app)
    {
        $this->app = $app;
    }
}
```

However, in many cases you may find that it is simpler to just use the `app()` helper function and avoid dependency injection altogether.

##### Config

WP Headless autoloads all of the configuration files into a `Config` object after it creates the `Plugin` container. The config ID for each file will simply be each file's basename sans its .php extension.

For example, if your class accepts the meta field config and the config file is `meta-fields.php`, it's config ID will simply be `meta-fields`.

```php
    'example' => [
        'class' => SB2Media\Headless\Example\Example::class,
        'config' => [
            'meta-fields'
        ]
    ],
```

```php
class Example {
    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
```

##### Class Dependencies

Any class dependencies can be defined by simply including the dependency's container ID in the `dependencies` array.

```php
    'other' => [
        'class' => SB2Media\Headless\Other\OtherClass::class,
    ],
    'example' => [
        'class' => SB2Media\Headless\Example\Example::class,
        'dependencies' => [
            'other'
        ]
    ],
```

```php
class Example {
    public function __construct(OtherClass $object)
    {
        $this->object = $object;
    }
}
```

##### Additional Parameters

Any additional parameters can be defined in the `parameters` array.

```php
class Example {
    public function __construct(array $params, string $other_param)
    {
        $this->params = $params;
        $this->other_param = $other_param;
    }
}
```

```php
    'example' => [
        'class' => SB2Media\Headless\Example\Example::class,
        'params' => [
            [
                'key1' => 'value1',
                'key2' => 'value2',
                'key3' => 'value3',
            ],
            'other_param_value'
        ]
    ],
```

### Base Collection

The first section of objects created are from WP Headless' base classes. These should be left alone with the exception of the `Compatibility` class.

The `Compatibility` class accepts an optional plugin dependency array parameter. By default, the WP Headless starter plugin requires WP GraphQL to be activated before you can activate and run the starter.

```php
    'compatibility' => [
        'class' => SB2Media\Headless\Setup\Compatibility::class,
        'app' => true,
        'params' => [
            'plugin_dependencies' => [
                [
                    'name' => 'WP GraphQL',
                    'path' => 'wp-graphql/wp-graphql.php',
                    'src' => 'https://docs.wpgraphql.com/getting-started/install-and-activate',
                ],
            ]
        ]
    ],
```

You may remove the WP GraphQL dependency if you wish to use WP Headless without GraphQL. You may also add any other plugin dependencies here. Please note the `path` parameter is the relative path from the WordPress `plugins` folder to the plugin's root file.

### WordPress Collection

WordPress' various API's are found in this collection. These classes abstract away WordPress' API's and accept their respective config files.

```php
    'custom-post-types' => [
        'class'  => SB2Media\Headless\WordPress\CustomPostTypes::class,
        'app' => true,
        'config' => [
            'post-types'
        ]
    ],
```

These do not need to be modified from their default state, however you may wish to remove or comment out any API's you are not using so they won't be loaded.

### GraphQL Collection

The base GraphQL classes are found in this collection. These do not need to be modified from their default state, however they may be removed or commented out if your plugin does not need GraphQL support or there is a component you do not need.

```php
'graphql' => [
        'graphql-types' => [
            'class'  => SB2Media\Headless\GraphQL\Types::class,
            'app' => true,
            'config' => [
                'graphql-types',
            ],
        ],
        'graphql-settings' => [
            'class'  => SB2Media\Headless\GraphQL\Settings::class,
            'app' => true,
            'config' => [
                'settings',
            ],
        ],
        'graphql-meta-fields' => [
            'class'  => SB2Media\Headless\GraphQL\MetaFields::class,
            'app' => true,
            'config' => [
                'meta-fields',
            ],
        ],
        'media-details-graphql' => [
            'class' => SB2Media\Headless\Media\MediaDetailsGraphQL::class,
        ],
    ],
```

### Extension Collection

This is the section in the starter plugin where we recommend you define any classes specific to your plugin. You may also rename this collection or add additional collections depending on the complexity and needs of your plugin.

```php
    'extension' => [
        'movie-details-graphql' => [
            'class' => SB2Media\MovieDemo\Movies\MovieDetailsGraphQL::class,
        ],
    ],
```
