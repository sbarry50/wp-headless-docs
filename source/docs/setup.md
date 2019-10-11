---
title: Setup
description: Guide for setting up the WP Headless Starter plugin
extends: _layouts.documentation
section: content
---

## Setup

The WP Headless starter plugin is meant to be set up in a development environment prior to activating in production.

We recommend following these steps prior to beginning development.

### 1. The plugin directory

Change the `wp-headless-starter` directory you just cloned in the `plugins` directory to the name of your plugin.

For illustration purposes, we will be using the [WP Headless Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo) as an example throughout the docs.

### 2. The main plugin file

The name of the main plugin should be changed from `headless-starter.php` to a name of your choosing. In our example, we changed it to `movie-demo.php`.

The header data in the main plugin will also need to be updated with your project details.

### 3. Namespaces

The WP Headless starter plugin is namespaced. The default namespaces throughout the project will need to be updated from `SB2Media\Starter` to a namespace of your choosing.

We found the easiest way to do this is using your IDE to perform a simple find and replace in your project directory. In our example, we updated all instances of `SB2Media\Starter` to `SB2Media\MovieDemo`.

### 4. Update composer.json

Update the included `composer.json` file with your project details.

Please note you will need to update the namespaces to the namespaces you chose in the previous step. In our case we updated `"SB2Media\\Starter\\": "src/"` to `"SB2Media\\MovieDemo\\": "src/"`.

```json
  "autoload": {
    "psr-4": {
      "SB2Media\\MovieDemo\\": "src/"
    },
    "classmap": [],
    "files": [
      "src/helpers.php"
    ]
  },
```

Once you have finished updating the file, navigate to the plugin's root directory in your console and run `composer update`.

### 5. Update package.json

Update the included `package.json` file with your project details.

Once you have finished updating the file, you may navigate to the plugin's root directory in your console and run `npm install`.

### 6. Compiling assets

The WP-Headless starter plugin uses [Laravel Mix](https://laravel.com/docs/5.8/mix) for compiling assets.

Out of the box it is setup to simply compile the included `headless-starter.scss` file into CSS and compile the included Javascript files. However, you may configure this however you want in the `webpack.mix.js` file.

Please note you will need to add any additional files you wish to compile here.

You may compile the assets from the command line with either `npm run dev` to compile them once or `npm run watch` to compile on save.

### 7. Activation

You may activate the plugin at this point if you wish, but please note this is a starter plugin and offers no discernable functionality out of the box.
