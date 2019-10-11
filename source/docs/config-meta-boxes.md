---
title: Meta Box Configuration
description: Guide for the meta box configuration file
extends: _layouts.documentation
section: content
---
## Meta Boxes

WP Headless allows you to easily add meta boxes via the `meta-box.php` configuration file.

Meta box config entries accept the same parameters as the WordPress function [add_meta_box()](https://developer.wordpress.org/reference/functions/add_meta_box/).

```php
    [
        'id'       => 'movie_details',
        'title'    => 'Movie Details',
        'callback' => 'meta-box.php',
        'screen'   => 'movie',
        'context'  => 'normal',
        'priority' => 'high',
        'args'     => [],
    ],
```

WP Headless is packaged with a base `meta-box.php` view template for displaying meta boxes which is set as the `callback` in the example above. You may modify it or add your own if you wish.

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases here, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.

### Descriptions

The default `meta-box.php` view template allows you to optionally add descriptions for each meta field. These descriptions will appear under the meta field title in left column of the meta box layout if you fill in the `description` parameter in the [meta field config entry](/docs/config-meta-field).

### Vue.js Support

Default WP Headless menu pages include Vue support. If you wish to include a Vue component, you can pass an additional `vue_id` parameter to the configuration's optional `args` parameter.

```php
    'args' => [
        'vue_id' => 'app'
    ],
```

Note you will also need to [enqueue](/docs/config-enqueue) the applicable javascript files for the submenu page.
