---
title: GraphQL Resolvers
description: Guide to creating resolvers for custom GraphQL types in WP Headless
extends: _layouts.documentation
section: content
---
## Special GraphQL Configuration Arguments

Any custom setting or meta field that is of a different GraphQL type than `String` will need to include a special `graphql` parameter in its configuration entry.

The only exceptions are fields using the `multi-checkbox.php` and `multi-select.php` view template files as the `callback`. These are automatically resolved to the list of String type since they are stored as arrays.

The `graphql` argument is an array with three parameters.

* `type` - The GraphQL type ID that was used when registering the GraphQL type.
* `description` - The description that will be shown in the GraphiQL documentation explorer.
* `resolver` - The application container ID set in the [providers config](/docs/config-providers) for the class that contains the GraphQL resolver for the field.

### Movie Demo Examples

Our [Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo) provides three examples of how to implement this.

As seen in the movie poster meta field config example below, a `graphql` argument can be added to the end of the entry and contains three parameters.

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
        ],
        'graphql' => [
            'type' => 'MediaDetails',
            'description' => 'The official movie poster',
            'resolver' => 'media-details-graphql',
        ]
    ],
```

Since this is an image upload field we can set the type to `MediaDetails` which is included with WP Headless. We also include a description of the field and set the resolver to the container ID of the Media Details GraphQL resolver.

Next we have the movie rating dropdown list field which we're going to set to the `MovieRatings` enum type.

```php
    [
        'id'          => 'movie_rating',
        'title'       => 'Movie Rating',
        'description' => 'How would you rate this movie?',
        'callback'    => 'select.php',
        'meta_box'    => 'movie_details',
        'args'        => [
            'options' => [
                [
                    'value' => 'must_see',
                    'label' => 'Must see',
                ],
                [
                    'value' => 'worth_watching',
                    'label' => 'Worth watching',
                ],
                [
                    'value' => 'only_if_bored',
                    'label' => 'Only if bored',
                ],
                [
                    'value' => 'dont_bother',
                    'label' => 'Don\'t bother',
                ],
            ],
        ],
        'graphql' => [
            'type' => 'MovieRating',
            'description' => 'Movie rating',
            'resolver' => 'movie-ratings-graphql'
        ]
    ],
```

And finally we have a movie details field which is set to the `MovieDetails` object type.

```php
    [
        'id'          => 'movie_details',
        'title'       => 'Movie Details',
        'description' => 'Not used as an input. Demo purposes for GraphQL only.',
        'callback'    => '',
        'meta_box'    => 'movie_details',
        'args'        => [],
        'graphql' => [
            'type' => 'MovieDetails',
            'description' => 'Movie Details GraphQL object demo',
            'resolver' => 'movie-details-graphql'
        ]
    ],
```
