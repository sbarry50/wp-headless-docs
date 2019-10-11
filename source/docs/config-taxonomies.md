---
title: Custom Taxonomies Configuration
description: Guide for the custom taxonomies configuration file
extends: _layouts.documentation
section: content
---
## Custom Taxonomies

WP Headless allows you to easily add custom taxonomies via the `taxonomies.php` configuration file.

Custom taxonomy config entries will accept the same parameters as the WordPress function [register_taxonomy()](https://developer.wordpress.org/reference/functions/register_taxonomy/). Please note not all possible parameters are in the example below.

```php
    [
        'id'          => 'movie_genre',
        'label'       => __('Movie Genre', $text_domain),
        'description' => __('Movie Genre Description', $text_domain),
        'labels'      => [
            'name'               => _x('Movie Genres', 'post type general name', $text_domain),
            'singular_name'      => _x('Movie Genre', 'post type singular name', $text_domain),
            'menu_name'          => _x('Movie Genres', 'admin menu', $text_domain),
            'name_admin_bar'     => _x('Movie Genre', 'add new on admin bar', $text_domain),
            'add_new'            => _x('Add New', 'movie genre', $text_domain),
            'add_new_item'       => __('Add New Movie Genre', $text_domain),
            'new_item'           => __('New Movie Genre', $text_domain),
            'edit_item'          => __('Edit Movie Genre', $text_domain),
            'view_item'          => __('View Movie Genre', $text_domain),
            'all_items'          => __('All Movie Genres', $text_domain),
            'search_items'       => __('Search Movie Genres', $text_domain),
            'parent_item_colon'  => __('Parent Movie Genres:', $text_domain),
            'not_found'          => __('No movie genres found.', $text_domain),
            'not_found_in_trash' => __('No movie genres found in Trash.', $text_domain)
        ],
        'public'              => true,
        'supports'            => ['movie'],
        'hierarchical'        => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'show_in_graphql'     => true, // If using WPGraphQL Plugin
        'graphql_single_name' => 'MovieGenre', // If using WPGraphQL Plugin
        'graphql_plural_name' => 'MovieGenres', // If using WPGraphQL Plugin
    ],
```

Note that if you are using WP Headless and WP GraphQL for GraphQL support, you must include the final three parameters in your configuration.
