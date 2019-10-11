---
title: Field Parameters
description: Guide to the fields templates parameters
extends: _layouts.documentation
section: content
---
## Field Parameters

WP Headless is packaged with a variety of input fields to use out of the box by simply setting the custom settings and/or meta fields `callback` parameter to the name of the view template file.

Each of these templates however require various pieces of data to properly display. The most basic templates such as a standard text input field do not require any additional arguments beyond the `id` while fields like a select box will require an array of options.

Both [settings](/docs/config-settings) and [meta fields](/docs/config-meta-fields) configuration file entries include an `args` array parameter where you can set any additional arguments a particular field may require.

Let's run down each of the parameters and go over which templates they apply to.

### Shared Parameters

These parameters are shared across many of the view templates.

#### Required

The required HTML attribute can be added to all applicable fields by simply setting a `required` boolean flag within `args`.

```php
    'args' => [
        'required' => true,
    ],
```

The following view templates will accept the `required` parameter.

* `date.php`
* `email.php`
* `multi-select.php`
* `multi-text.php` _Note that all inputs will be marked as required_
* `number.php`
* `password.php`
* `select.php`
* `tel.php`
* `text.php`
* `textarea.php`
* `zipcode.php`

#### Placeholder

Placeholder text can be set for many input fields with the `placeholder` parameter.

```php
    'args' => [
        'placeholder' => 'This is placeholder text',
    ],
```

The following view templates will accept the `placeholder` parameter.

* `email.php`
* `number.php`
* `tel.php`
* `text.php`
* `textarea.php`
* `zipcode.php`

#### Label

A label that will appear above the field can be set with the `label` parameter.

```php
    'args' => [
        'label' => 'Choose an option:',
    ],
```

The following view templates will accept the `label` parameter.

* `checkbox.php`
* `image-upload.php`
* `multi-checkbox.php`
* `multi-select.php`
* `radio.php`
* `select.php`

#### Description

A description can be added underneath any field by setting the `description` parameter within `args`. Please note this is different from the main `description` parameter in meta field config entries. That is for adding a description to the left hand column of a meta box row.

```php
    'args' => [
        'description' => 'You can add additional instructions for your setting or field here',
    ],
```

All view templates will accept the `description` parameter.

#### Options

Fields that offer choices such as radio buttons or select drop-down lists must include the `options` parameter within `args` to populate the options.

The `options` parameter is an array of `label` and `value` key-value pair arrays.

```php
    'args' => [
        'label' => 'Choose your favorite food:',
        'options' => [
            [
                'label' => 'Cheeseburger',
                'value' => 'cheeseburger',
            ],
            [
                'label' => 'Tacos',
                'value' => 'tacos',
            ],
            [
                'label' => 'Pizza',
                'value' => 'pizza',
            ],
            [
                'label' => 'French Fries',
                'value' => 'french_fries',
            ],
    ],
```

Listing your options here works fine when you only have a handful of options, however if you have a long list of options you may set them with a function that returns the options in the same format.

For example, if you need a drop-down list of the US states you could have a function like this.

```php
namespace SB2Media\Starter;

function us_states()
{
    $states = [
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        // continued...
    ];

    foreach ($states as $abbr => $state) {
        $state_options[] = [
            'label' => $state,
            'value' => $abbr
        ];
    }

    return $state_options;
}
```

And set it in options like this.

```php
    'args' => [
        'options' => SB2Media\Starter\us_states()
    ]
```

The following view templates require the `options` parameter.

* `multi-checkbox.php`
* `multi-select.php`
* `radio.php`
* `select.php`

### Specific Parameters

Some parameters are specific to a particular view template.

#### Image Uploads

The `image-upload.php` view template accepts the following optional parameters, all shown with their default values. These do not need to be set if you wish to use the defaults.

```php
    'args' => [
        'label' => '',
        'admin_size'   => 'thumbnail',
        'admin_width'  => 150,
        'admin_height' => 150,
    ],
```

The `label` parameter will display a label message above the image field.

The `admin_size` parameter controls the size of the image that is fetched from WordPress' media library. For retina and other high resolution displays you may want to set this to `medium` or thumbnails at the default 150x150 size will appear blurry.

The `admin_width` and `admin_height` parameters control the width and height that the image will display in the admin.

Also, please not that the `callback` for the `image-upload.php` template must be set to `['media', 'render']` and not the file name like the others so the configuration data can pass through a filter before it reaches the template.

#### Multi-Text

The `multi-text.php` view template accepts a mandatory `num_inputs` argument.

```php
    'args' => [
        'num_inputs' => 3,
    ],
```

The `num_inputs` parameter is an integer that sets the number of text input fields that are displayed.

### Custom View Templates & Parameters

You may create your own custom field view templates for settings and meta fields if your plugin requires functionality more complex than the pre-packaged fields can provide.

The full config entry array is passed on to the templates in an `$args` variable so any additional arguments your templates require may either be added to the `args` array or included as a primary parameter in the configuration.

If you have views that require data to be processed before it is sent to the template you can accomplish that with [custom callbacks](/docs/config-callbacks).
