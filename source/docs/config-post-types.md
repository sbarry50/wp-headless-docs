---
title: Custom Post Type Configuration
description: Guide for the custom post type configuration file
extends: _layouts.documentation
section: content
---
## Custom Post Types

WP Headless allows you to easily add custom post types via the `post-types.php` configuration file.

Custom post type config entries will accept the same parameters as the WordPress function [register_post_type()](https://developer.wordpress.org/reference/functions/register_post_type/). Please note not all possible parameters are in the example below.

```php
    [
        'id'          => 'movie',
        'label'       => __('Movie', $text_domain),
        'description' => __('Movie Description', $text_domain),
        'labels'      => [
            'name'               => _x('Movies', 'post type general name', $text_domain),
            'singular_name'      => _x('Movie', 'post type singular name', $text_domain),
            'menu_name'          => _x('Movies', 'admin menu', $text_domain),
            'name_admin_bar'     => _x('Movie', 'add new on admin bar', $text_domain),
            'add_new'            => _x('Add New', 'movie', $text_domain),
            'add_new_item'       => __('Add New Movie', $text_domain),
            'new_item'           => __('New Movie', $text_domain),
            'edit_item'          => __('Edit Movie', $text_domain),
            'view_item'          => __('View Movie', $text_domain),
            'all_items'          => __('All Movies', $text_domain),
            'search_items'       => __('Search Movies', $text_domain),
            'parent_item_colon'  => __('Parent Movies:', $text_domain),
            'not_found'          => __('No movies found.', $text_domain),
            'not_found_in_trash' => __('No movies found in Trash.', $text_domain)
        ],
        'taxonomies'          => [],
        'public'              => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-format-video',
        'supports'            => ['title','movie_details'],
        'has_archive'         => false,
        'show_in_rest'        => true,
        'show_in_graphql'     => true, // If using WPGraphQL Plugin
        'graphql_single_name' => 'Movie', // If using WPGraphQL Plugin
        'graphql_plural_name' => 'Movies', // If using WPGraphQL Plugin
    ],
```

Note that if you are using WP Headless and WP GraphQL for GraphQL support, you must include the final three parameters in your configuration.
