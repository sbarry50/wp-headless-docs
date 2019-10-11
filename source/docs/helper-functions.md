---
title: Helper Functions
description: Guide to the helper functions packaged with WP Headless starter
extends: _layouts.documentation
section: content
---

## Helper Functions

The WP Headless starter plugin is packaged with several helper functions to aid in developing plugins with the WP Headless framework.

They can be found at `src/helpers.php` and you are free to add your own to that file.

Let's run down what each one does.

### App {#app}

The `app()` helper function is based on Laravel's app function and sets/gets the application container instance. It is also capable of resolving objects from the container by passing it the object's container ID.

```php
app($plugin_root_file); // Set the application container instance
app();                  // Get the application container instance
app($container_id);     // Get the instance of an object registered in the container
```

### Config {#config}

The `config()` helper function is based on Laravel's config function and sets/gets a specified configuration value. If you pass an array into this function it will assume you are setting an array of values.

```php
config(); // Gets the Config instance
config($array); // Sets an array of values
config($config_id); // Gets a configuration array
```

You can retrieve the full configuration array from any config file by passing the file name (without the .php extension) to the config helper.

```php
config('meta-fields'); // Returns the full config/meta-fields.php array
```

### Config Path {#config-path}

The `configPath()` helper function will return the full path of a configuration file by passing the file name without the .php extension.

```php
configPath('meta-fields'); // Will return the full path to the meta-fields.php config file.
```

### Path {#path}

The `path()` helper function returns the path of the plugin, subdirectory and/or file.

```php
path(); // Returns the path to the plugin root
path('config'); // Returns the full path to the config directory
path('config/meta-fields.php'); // Returns the full path to the meta-fields.php config file
```

### URL {#url}

The `url()` helper function returns the url of the plugin, subdirectory or file.

```php
url(); // Returns the url to the plugin
url('dist/js'); // Returns the url to the /dist/js directory
url('dist/js/main.js'); // Returns the url to the main.js config file
```

### View {#view}

The `view()` helper function returns the (sub)directory path of the view file.

```php
view(); // Returns the path to the views directory
view('meta-box'); // Returns the path to the meta-box.php view template file
view('fields/text'); // Returns the path to the text.php view template file in the fields directory
```
