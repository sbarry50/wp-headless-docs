---
title: Submenu Configuration
description: Guide for the submenus configuration file
extends: _layouts.documentation
section: content
---
## Submenus

Much like [top-level menus](/docs/config-menus), WP Headless allows you to easily add submenus via the `submenus.php` configuration file.

Submenu config entries accept the same parameters as the WordPress function [add_submenu_page()](https://developer.wordpress.org/reference/functions/add_submenu_page/).

```php
    [
        'parent_slug'  => 'movie-settings',
        'page_title'   => 'Movie Submenu',
        'menu_title'   => 'Movie Submenu',
        'capability'   => 'manage_options',
        'menu_slug'    => 'movie-submenu',
        'callback'     => 'menu-page.php',
        'args' => [],
    ],
```

WP Headless is packaged with a base `menu-page.php` view template for displaying submenu pages which is set as the `callback` in the example above. You may modify that file or add your own if you wish.

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases here, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.

### Default Top-Level WordPress Menu Submenus

If you wish to add a submenu to a default top-level WordPress menu page, you can simply set the `parent_slug` parameter to the name of the menu (case sensitive).

```php

    'parent_slug' => 'Dashboard',
    'parent_slug' => 'Posts',
    'parent_slug' => 'Media',
    'parent_slug' => 'Pages',
    'parent_slug' => 'Comments',
    'parent_slug' => 'Appearance',
    'parent_slug' => 'Plugins',
    'parent_slug' => 'Users',
    'parent_slug' => 'Tools',
    'parent_slug' => 'Settings',
```

### Custom Post Type Submenus

If you wish to add a submenu to a custom post type, you can set the `parent_slug` to the relative URL of the post type's top-level menu page.

```php
    'parent_slug' => 'edit.php?post_type=your_post_type'
```

### Vue.js Support

Default WP Headless menu pages include Vue support. If you wish to include a Vue component, you can pass an additional `vue_id` parameter to the configuration's optional `args` parameter.

```php
    'args' => [
        'vue_id' => 'app'
    ],
```

Note you will also need to [enqueue](/docs/config-enqueue) the applicable javascript files for the submenu page.
