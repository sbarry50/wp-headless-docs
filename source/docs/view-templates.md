---
title: View Templates
description: Guide to using view files in WP Headless
extends: _layouts.documentation
section: content
---
## View Templates

WP Headless uses a view or template system for displaying output on a page.

The starter plugin is packaged with default views for menu/submenu pages, sections and meta boxes in the `resources/views/` folder. A variety of meta-field/settings input fields can be found in the `resources/views/fields/` subfolder. There is also an `resources/views/errors/` subfolder for error templates.

View files can be rendered using the `View` class `render` method. The `render` method accepts the path of the view file relative to the `resources/views` directory in the first parameter. An array of arguments can optionally be passed as the second parameter for templates that require dynamic data to render.

```php
    app('views')->render('menu-page'); // Displays resources/views/menu-page.php
    app('views')->render('fields/text', $args); // Outputs the text input field with data from $args
```

You may add additional custom templates to the views folder if you wish, however with the way the callback and file rendering system works all files in the views folder and its subfolders must have an unique name. For example, you cannot have a template named `example.php` in both the main views folder and the fields subfolder.
