<?php

return [
    'Getting Started' => [
        'url' => 'docs/getting-started',
        'children' => [
            'Installation' => 'docs/installation',
            'Setup' => 'docs/setup',
        ],
    ],
    'The Application Container' => 'docs/application-container',
    'Event Manager' => 'docs/events',
    'View Templates' => 'docs/view-templates',
    'Configuration' => [
        'url' => 'docs/configuration-files',
        'children' => [
            'Providers' => 'docs/config-providers',
            'Enqueue' => 'docs/config-enqueue',
            'Callbacks' => 'docs/config-callbacks',
            'Menus' => 'docs/config-menus',
            'Submenus' => 'docs/config-submenus',
            'Sections' => 'docs/config-sections',
            'Settings' => 'docs/config-settings',
            'Custom Post Types' => 'docs/config-post-types',
            'Custom Taxonomies' => 'docs/config-taxonomies',
            'Meta Boxes' => 'docs/config-meta-boxes',
            'Meta Fields' => 'docs/config-meta-fields',
            'Field Parameters' => 'docs/config-field-parameters',
            'GraphQL Parameters' => 'docs/config-graphql-parameters',
            'GraphQL Types' => 'docs/config-graphql-types',
        ],
    ],
    'GraphQL' => [
        'url' => 'docs/graphql',
        'children' => [
            'Custom Types' => 'docs/graphql-custom-types',
            'Resolvers' => 'docs/graphql-resolvers',
            'Configuration Parameters' => 'docs/graphql-config-parameters',
        ]
    ],
    'Vue.js Integration' => 'docs/vue',
    'Helper Functions' => 'docs/helper-functions',
];
