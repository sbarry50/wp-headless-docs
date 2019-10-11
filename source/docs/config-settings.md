---
title: Settings Configuration
description: Guide for the settings configuration file
extends: _layouts.documentation
section: content
---
## Settings

WP Headless allows you to easily add setting fields via the `settings.php` configuration file.

Setting config entries accept similar parameters as the WordPress functions [register_setting()](https://developer.wordpress.org/reference/functions/add_menu_page/) and [add_settings_field()](https://developer.wordpress.org/reference/functions/add_settings_field/).

A basic text input field setting could be defined like this.

```php
    [
        'id'       => 'movie_name',
        'title'    => 'Movie Name',
        'callback' => 'text.php',
        'page'     => 'movie-settings',
        'section'  => 'movie-settings-section',
        'args'     => [],
    ],
```

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.

### Additional Arguments

A wide variety of parameters can be set inside the `args` array depending on the type of field being set. Please refer to the [fields docs](/docs/view-fields) for more details.

Also, you may include any additional custom parameters within the `args` array that your custom setting field and its corresponding view template might need.
