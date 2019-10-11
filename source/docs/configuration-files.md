---
title: Configuration
description: Guide to using configuration files to setup and build your plugin
extends: _layouts.documentation
section: content
---

## Configuration

The WP Headless library was developed so WordPress plugins could be more rapidly developed by abstracting away WordPress' various API's and using configuration files to extend functionality. These are main driver of the WP Headless engine however more complex functionality can be crafted by tying into WP Headless' object-oriented base.

The WP Headless starter plugin comes bundled with config files that makes it easy to add custom post types, meta boxes, meta fields, taxonomies, settings pages, subpages, sections and settings fields along with custom image sizes.

Custom stylesheets and scripts are also easily enqueued via a config file for the administration dashboard. While WP Headless' intended use case is for using WordPress as a headless CMS, there is a seperate config file included for the front-end if you still wish to use WordPress' traditional theming system.

Custom GraphQL types may also defined in a configuration file. In many cases however, a seperate class will need to be created to resolve the type which will be covered more extensively later in the docs.

The providers config file however is the most important. This is the config that WP Headless uses to autoload its various classes and the order it instiantes them.
