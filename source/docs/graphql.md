---
title: GraphQL
description: Guide to using GraphQL with WP Headless
extends: _layouts.documentation
section: content
---
## GraphQL

WP Headless comes with GraphQL support out of the box when paired with [WP GraphQL](https://www.wpgraphql.com/). In fact, it's main purpose is to serve as a framework to more easily craft plugins that extend [WP GraphQL](https://www.wpgraphql.com/) which we feel is ideal when using WordPress as a headless CMS.

GraphQL is its own animal though and we do not intend to try to rewrite the docs on working with it here so we highly recommend reading the [WP GraphQL docs](https://www.wpgraphql.com/docs/) and other GraphQL resources if you're new to it.

Our intention here is to instruct you on how to properly work with it in the context of the WP Headless framework.

### Hands off... mostly

Thanks to WP GraphQL, extended functionality such as [custom post types](/docs/config-post-types), [taxonomies](/docs/config-taxonomies) and [settings](/docs/config-settings) of the `String` GraphQL type become queryable by merely registering them via WordPress' API's and passing a `show_in_graphql` parameter with its configuration.

WP Headless makes this even easier by allowing you to register these with [configuration files](/docs/configuration-files) and in the case of settings, the `show_in_graphql` parameter only needs to be passed if you don't want the setting to be queryable.

```php
    'args' => [
        'show_in_graphql' => false
    ]
```

The same goes for custom meta fields of the `String` type, however in this case we abstracted away WP GraphQL's API for registering the fields so all you need to do is create them with the [meta fields config file](/docs/config-meta-fields). And like settings, these automatically become queryable unless you pass the `'show_in_graphql' => false` argument in a field's config entry.

### More Complex Cases

While creating a simple text input or dropdown list doesn't require any additional work on your part to make them queryable via GraphQL that is not always the case when you have more complex settings and meta fields in your plugin.

These cases require a little more work to get them working with GraphQL, however WP Headless attempts to make that as easy as possible with the following steps.

* [Custom types](/docs/graphql-custom-types)
* [Resolvers](/docs/graphql-resolvers)
* [Configuration parameters](/docs/graphql-config-parameters)

### Querying with GraphQL

Querying the data from the custom functionality you create with WP Headless is no different than WP GraphQL. Please see [their docs](https://docs.wpgraphql.com/) for information on querying.
