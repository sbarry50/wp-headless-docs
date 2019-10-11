---
title: Enqueue Configuration
description: Guide for the enqueue and admin enqueue configuration files
extends: _layouts.documentation
section: content
---

## Enqueue

WP Headless allows you to easily register scripts and stylesheets with WordPress' enqueue system with the `admin-enqueue.php` for the WP administration panel and `enqueue.php` for WP's front end theming system.

If you are using WordPress as a headless CMS, you will only need to worry about the `admin-enqueue.php` file.

Each file is seperated into stylesheets for enqueuing CSS files and scripts for enqueing javascript files.

### Stylesheets

Stylesheet entries accept similar parameters as [wp_enqueue_style()](https://developer.wordpress.org/reference/functions/wp_enqueue_style/).

```php
    [
        'id'           => 'headless-starter',
        'src'          => SB2Media\Starter\url('dist/css/headless-starter.css'),
        'dependencies' => [],
        'version'      => false,
        'media'        => 'all',
    ],
```

The only difference is we have assigned the \$handle in the docs to the `id` parameter.

Please note that you can use the `url()` helper function for the source url but you will need to include the qualified namespace.

### Scripts

Script entries accept similar parameters as [wp_enqueue_script()](https://developer.wordpress.org/reference/functions/wp_enqueue_script/).

```php
    [
        'id'           => 'main',
        'src'          => SB2Media\Starter\url('dist/js/main.js'),
        'dependencies' => [],
        'version'      => '1.0.0',
        'in_footer'    => true,
    ],
```

The only difference is we have assigned the \$handle in the docs to the `id` parameter.

Please note that you can use the `url()` helper function for the source url here as well but you will need to include the qualified namespace.

### Conditional Loading

An optional `only_load` parameter may also be set to only enqueue files on specific pages or post types.

For example, if your plugin uses a Vue component but only on a particular settings page and pages in the `example` post type you can tell WP Headless to only load Vue on those pages.

```php
    [
        'id'           => 'vue',
        'src'          => 'https://unpkg.com/vue@2.6.9/dist/vue.js',
        'dependencies' => [],
        'version'      => false,
        'in_footer'    => true,
        'only_load' => [
            'page_slug' => 'example-submenu-one',
            'post_type' => 'example'
        ]
    ],
```

### Localization {#localization}

In cases where you need to pass data from WordPress to one of your script files via `wp_localize_script()`, you can add an optional `localization` argument to the script's enqueue config entry. The localization parameter has three arguments of it's own.

- `js_object_name` - Name for the JavaScript object. Passed directly, so it should be a qualified JS variable.
- `callback` - The callback function that will return the values to be localized. Accepts any callable. Must return an array.
- `args` - Optional callback arguments. Must be an array.

```php
    [
        'id'           => 'main',
        'src'          => SB2Media\Starter\url('dist/js/main.js'),
        'dependencies' => [],
        'version'      => '1.0.0',
        'in_footer'    => true,
        'localization' => [
            'js_object_name' => 'exampleData',
            'callback' => ['container-id', 'callbackMethod'],
            'args' => [
                'example parameter'
            ]
        ]
    ]
```

As seen above, the `callback` parameter here allows you to use the application container ID in the callback array just like [callbacks in meta fields and settings](/docs/config-callbacks#callables).
