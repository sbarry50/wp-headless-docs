---
title: GraphQL Parameters
description: Guide to the fields templates parameters
extends: _layouts.documentation
section: content
---
## GraphQL Parameters

WP Headless supports GraphQL out of the box when coupled with WP GraphQL.

Custom post types, taxonomies and settings and meta fields of the `String` GraphQL type added via configuration files are queryable without any additional parameters, steps or code. This includes all of the default view templates with the exception of `image-upload.php`.

However, any settings or meta fields that are not of the `String` type will require an additional `graphql` parameter in their configuration entry. Please the [GraphQL section](/docs/graphql-config-parameters) for details on how to properly set this.
