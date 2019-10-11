---
title: Callbacks
description: Guide to callback functions in configuration files
extends: _layouts.documentation
section: content
---

## Callbacks

Many of WordPress' API's accept callback functions for outputting content on the page.

There are two primary ways of handling callbacks in WP Headless' configuration files.

### View files {#views}

The easiest way to handle callbacks in configuration files is to simply set the `callback` parameter to the name of the view file.

```php
    'callback' => 'menu-page.php' // Calls the menu page template
    'callback' => 'text.php' // Calls the text field template in the fields subfolder
```

WP Headless will scan the entire views directory including its subfolders for the file you specify here so you do not need to include the subfolder in the designation.

The rest of the configuration data will be passed to the template. And in the case of setting fields and meta fields its value will be passed along as well if it has been saved in the database. Also, you may include additional arguments in the config entry if necessary.

### Callables {#callables}

While the view method is the simplest and does the trick in most cases, there may be instances where more processing needs to be done before the data is ready to be passed to the view template.

In these cases, you may call a traditional callback function or class method. If you are calling a class method, you can use the application container ID in the callable array's first entry and WP Headless will resolve the object out of the container before attempting to call the method.

For instance, WP Headless is packaged with an `image-upload.php` field, however simply passing the file name to the `callback` parameter will not work because the upload needs to go through a filter before the proper data can be sent to the view file. So in this case, we call a `render()` method on the `Media` object which filters the data before it is passed to the `View` object's `render()` method. We do this by simply setting the `callback` parameter to an array with the Media object's container ID and the method name as demonstrated in our [Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo).

```php
    [
        'id'          => 'movie_poster',
        'title'       => 'Movie Poster',
        'description' => 'Upload a movie poster',
        'callback'    => ['media', 'render'],
        'meta_box'    => 'movie_details',
        'args'        => [
            'admin_size'   => 'large',
            'admin_width' => 400,
            'admin_height' => 600,
            'graphql_size' => 'full',
        ],
        'graphql' => [
            'type' => 'MediaDetails',
            'resolver' => 'media-details-graphql',
        ]
    ],
```

As you can see Media's render method sends the filtered data instead of the raw configuration file data to the `image-upload` template.

```php
    // SB2Media\Headess\Media\Media::class
    public function render(array $config)
    {
        $this->app->get('views')->render('fields/image-upload', $this->imageUploadFilter($config));
    }
```

Also, please note that you are not required to use the application container ID when designating the callback. Any [valid callable type](https://www.php.net/manual/en/language.types.callable.php) can be set here.
