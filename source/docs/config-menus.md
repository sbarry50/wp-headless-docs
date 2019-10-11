---
title: Menu Configuration
description: Guide for the menus configuration file
extends: _layouts.documentation
section: content
---
## Menus

WP Headless allows you to easily add top-level menus via the `menus.php` configuration file.

Menu config entries accept the same parameters as the WordPress function [add_menu_page()](https://developer.wordpress.org/reference/functions/add_menu_page/).

```php
    [
        'page_title' => 'Movie Settings',
        'menu_title' => 'Movie Settings',
        'capability' => 'manage_options',
        'menu_slug'  => 'movie-settings',
        'callback'   => 'menu-page.php',
        'icon_url'   => 'dashicons-editor-video',
        'position'   => null,
    ],
```

WP Headless is packaged with a base `menu-page.php` view template for displaying menu pages which is set as the `callback` in the example above. You may modify that file or add your own if you wish.

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases here, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.

### Vue.js Support

Default WP Headless menu pages include Vue support. If you wish to include a Vue component, you can pass an additional `vue_id` parameter to the configuration's optional `args` parameter.

```php
    'args' => [
        'vue_id' => 'app'
    ],
```

Note you will also need to [enqueue](/docs/config-enqueue) the applicable javascript files for the menu page.
