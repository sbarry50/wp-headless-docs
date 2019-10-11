---
title: Sections Configuration
description: Guide for the sections configuration file
extends: _layouts.documentation
section: content
---
## Sections

WP Headless allows you to easily add sections via the `sections.php` configuration file.

Section config entries accept the same parameters as the WordPress function [add_settings_section()](https://developer.wordpress.org/reference/functions/add_settings_section/).

```php
    [
        'id'       => 'movie-settings-section',
        'title'    => 'Primary Settings',
        'callback' => 'section.php',
        'page'     => 'movie-settings',
    ],
```

WP Headless is packaged with a base `section.php` view template for displaying sections within menu pages which is set as the `callback` in the example above. This file is intentionally blank by default. You may modify it or add your own if you wish.

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases here, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.
