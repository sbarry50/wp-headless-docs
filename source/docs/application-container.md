---
title: The Application Container
description: Overview of the application container.
extends: _layouts.documentation
section: content
---

## The Application Container

The WP Headless library and starter plugin uses Pimple as its dependency injection container.

The WP Headless library features a core `Application` class that is an extention of Pimple's service container and contains all of the core properties of the plugin. However, the plugin's core `Plugin` class, which itself is an extension of the `Application` class, is the class that is actually instantiated by the plugin. This allows the developer to easily tie in any custom functionality that is too complex for the configuration files.

The `Plugin` class is the first object that is created in the plugin's life cycle prior to the providers config being loaded. One instance of the `Plugin` class is created for each plugin using the WP Headless library which allows for multiple plugins to use the library simulataneously without any conflicts.

### Working with the container

The application container can be easily accessed using the `app()` helper function.

Objects can be instantiated using the container's `set()` method.

```php
    app()->set('movies', new Movies());
```

However, in cases where you only need one instance of an object we recommend registering them in the [providers config](/docs/config-providers).

```php
    'movies' => [
        'class' => SB2Media\MovieDemo\Movies\Movies::class,
    ],
```

Any object that was registered with the container by either of these methods can be accessed with the `app()` helper function by simply passing the container ID of the object to the function.

For instance, if you needed to access the object we created above you could simply resolve it with `app('movies')`.
