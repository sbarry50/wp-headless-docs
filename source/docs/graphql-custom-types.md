---
title: Custom GraphQL Types
description: Guide to working with custom GraphQL types in WP Headless
extends: _layouts.documentation
section: content
---
## Custom GraphQL Types

Any settings or meta fields that are not one of the following core scalar types will require a custom GraphQL type.

* Boolean
* Id
* Integer
* Float
* String

WP GraphQL is packaged with a variety of custom WordPress related GraphQL types which can be found in the [Type folder](https://github.com/wp-graphql/wp-graphql/tree/master/src/Type). You may want to browse through those files to see if one fits your needs before writing your own.

Additionally, WP Headless comes with a `MediaDetails` object type for image uploads you may also find useful.

If those don't fit your use case, you can add your own type(s) with the `graphql-types.php` config file.

Each configuration entry will ultimately be passed to WP GraphQL's `register_graphql_enum_type()`, `register_graphql_object_type()` or `register_graphql_union_type()` functions depending on the type so your configurations will be similar to how you would write them if you were working directly with those functions.

Each of those functions take two parameters per the [WP GraphQL docs](https://docs.wpgraphql.com/extending/types) - a `type_name` and a `config`.

Our configuration entries require three primary arguments, all of which correspond to those functions in some way.

* `id` - A unique identifier for the type. Gets passed to the relevant function as the `type_name` parameter. Should be in PascalCase.
* `type` - Determines which aforementioned function gets called. Must either be `object`, `enum` or `union` as of now, however WP GraphQL intends to support registering custom `scalar` and `interface` types in the future.
* `args` - The configuration arguments for the type. Gets passed to the relevant function as the `config` parameter.

Custom GraphQL type configurations can be written in a variety of ways depending on the type and what you are trying to achieve. We are going to use our [Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo) as an example here, however it does not adequately cover all the ways GraphQL types can be registered. Please refer to the [WP GraphQL docs](https://docs.wpgraphql.com/extending/types) for more details.

### Movie Demo Examples

Our [Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo) registers two custom GraphQL types - an enumumeration type and an object type.

The object type includes the enum type so we will list the enum type first. It also happens to be the simpler of two as we are merely registering a `MovieRating` type with four possible values. Note that the `value` values must match the values that will be saved in the database.

```php
    [
        'id'   => 'MovieRating',
        'type' => 'enum',
        'args' => [
            'description' => 'How would you rate this movie?',
            'values'      => [
                'MUST SEE' => [
                    'value' => 'must_see'
                ],
                'WORTH WATCHING' => [
                    'value' => 'worth_watching'
                ],
                'ONLY IF BORED' => [
                    'value' => 'only_if_bored'
                ],
                'DONT BOTHER' => [
                    'value' => 'dont_bother'
                ],
            ],
        ],
    ],
```

Next we will register a `MovieDetails` object type which essentially takes all of the meta fields from our `movie` custom post type and puts them in an object to query via GraphQL. This isn't actually necessary in this particular case since the fields contained within can be queried individually, but it serves as an example of how to work with custom GraphQL types.

```php
    [
        'id'   => 'MovieDetails',
        'type' => 'object',
        'args' => [
            'description' => 'The movie details',
            'fields' => [
                'title' => [
                    'type' => 'String',
                    'description' => 'The movie title',
                    'resolve' => function ($movie_details) {
                        return isset($movie_details['title']) ? $movie_details['title'] : null;
                    }
                ],
                'rating' => [
                    'type' => 'MovieRating',
                    'description' => 'How would you rate this movie?',
                    'resolve' => function ($movie_details) {
                        return isset($movie_details['rating']) ? $movie_details['rating'] : null;
                    }
                ],
                'year' => [
                    'type' => 'String',
                    'description' => 'The year the movie was released.',
                    'resolve' => function ($movie_details) {
                        return isset($movie_details['year']) ? $movie_details['year'] : null;
                    }
                ],
                'actors' => [
                    'type' => [
                        'list_of' => 'String'
                    ],
                    'description' => 'The actors who starred in the movie.',
                    'resolve' => function ($movie_details) {
                        return isset($movie_details['actors']) ? $movie_details['actors'] : null;
                    }
                ],
                'poster' => [
                    'type' => 'MediaDetails',
                    'description' => 'Movie poster details.',
                    'resolve' => function ($movie_details) {
                        return isset($movie_details['poster']) ? $movie_details['poster'] : null;
                    }
                ],
            ]
        ],
    ]
```

As you can see, the `MovieDetails` object type includes several fields, each of which have their own GraphQL types.

* `title` - The movie title of the `String` type.
* `rating` - The movie rating of the `MovieRating` enum type we registered earlier.
* `year` - The year the movie was released of the `String` type.
* `actors` - The actors who played a role in the movie of the `['list_of' => 'String']` type since the cooresponding meta field is saved in the database as an array of strings.
* `poster` - The metadata for the movie poster image upload of the `MediaDetails` object type registered by WP Headless.

Each of these fields is resolved by a `resolve` method in a `MovieDetailsGraphQL` object that returns each of their respective values in an array which is passed to the anynomous function in each field's `resolve` parameter. This is covered more extensively in the [GraphQL resolver section of the docs](/docs/graphql-resolvers).
