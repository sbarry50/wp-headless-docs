---
title: Meta Fields Configuration
description: Guide for the meta fields configuration file
extends: _layouts.documentation
section: content
---
## Meta Fields

WP Headless allows you to easily add meta fields via the `meta-fields.php` configuration file.

Meta field config entries accept the following parameters. A basic text input field setting could be defined like this.

```php
    [
        'id'          => 'movie_title',
        'title'       => 'Movie Title',
        'description' => 'The title of the movie',
        'callback'    => 'text.php',
        'meta_box'    => 'movie_details',
        'args'        => [],
    ],
```

### Callbacks

While setting the `callback` parameter to the name of the view template should suffice in most cases, we recommend you read the [callback section](/docs/config-callbacks) for clarification on setting the `callback` parameter for more complex cases.

### Additional Arguments

A wide variety of parameters can be set inside the `args` array depending on the type of field being set. Please refer to the [fields docs](/docs/view-fields) for more details.

Also, you may include any additional custom parameters within the `args` array that your custom setting field and its corresponding view template might need.
