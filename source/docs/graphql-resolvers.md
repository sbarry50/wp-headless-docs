---
title: GraphQL Resolvers
description: Guide to creating resolvers for custom GraphQL types in WP Headless
extends: _layouts.documentation
section: content
---
## Resolvers

Though they are not always necessary, oftentimes you will need a resolver for resolving the fields within custom GraphQL types. These are usually needed when you have an enum or object type that needs values retrieved from the database or an API so they can be queried.

To write a resolver in WP Headless, you must create a new class within the `src` folder of the starter plugin that implements the `SB2Media\Headless\GraphQLResolverContract` interface. This class must contain a `resolve()` method that accepts the following parameters.

* `$config` - The GraphQL configuration
* `$value` - The value of the setting/meta-field in the WP database
* `$post_id` - The WP post unique identifier (optional)

The resolve method should return the values of the fields in the custom GraphQL type.

Also don't forget to register these objects in the [providers config](/docs/config-providers).

### Movie Demo Examples

We can use the Movie Demo plugin's resolvers as an example.

The `MovieRatings` enum type's resolver is very simple. It merely returns the value of the `movie_rating` meta field for the relevant WP post ID that is being passed into the resolve method.

```php
namespace SB2Media\MovieDemo\Movies;

use SB2Media\Headless\Contracts\GraphQLResolverContract;

class MovieRatingsGraphQL implements GraphQLResolverContract
{
    /**
     * Resolve the movie ratings for GraphQL
     *
     * @since 1.0.0
     * @param array $config
     * @param string|array $value
     * @param integer $post_id
     * @return string
     */
    public function resolve(array $config, $value, int $post_id = null)
    {
        return $value;
    }
}
```

Resolving the `MovieDetails` object type is a little more involved however. It requires we retrieve the values for the title, rating, year, actors and posters fields and pass them to the closure set to each's `resolve` parameter in the [type configuration](/docs/graphql-custom-types#movie-details-type-config). We can achieve this by assigning these values to an array and returning them in the resolver.

```php
namespace SB2Media\MovieDemo\Movies;

use SB2Media\Headless\Contracts\GraphQLResolverContract;
use function SB2Media\MovieDemo\app;
use function SB2Media\MovieDemo\config;

class MovieDetailsGraphQL implements GraphQLResolverContract
{
    /**
     * Resolve the movie details for GraphQL
     *
     * @since 1.0.0
     * @param array $config
     * @param string|array $value
     * @param integer $post_id
     * @return array
     */
    public function resolve(array $config, $value, int $post_id = null)
    {
        $movie_details = [];

        $movie_details['title'] = get_post_meta($post_id, 'movie_title', true);
        $movie_details['rating'] = get_post_meta($post_id, 'movie_rating', true);
        $movie_details['year'] = get_post_meta($post_id, 'movie_year', true);
        $movie_details['actors'] = get_post_meta($post_id, 'movie_actors', true);

        $poster_config = config()->getItem('movie_poster', 'meta-fields');
        $poster_value = get_post_meta($post_id, 'movie_poster', true);
        $movie_details['poster'] = app('media-details-graphql')->resolve($poster_config, $poster_value);

        return $movie_details;
    }
}
```

Note that since the poster field is of the `MediaDetails` object type we can resolve that field with that type's resolver.
