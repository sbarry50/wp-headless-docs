---
title: Vue.js Component Integration
description: Guide to integrating Vue.js components in WP Headless
extends: _layouts.documentation
section: content
---

## Vue.js Component Integration

Vue.js components can easily be integrated as a setting or meta field in WP Headless plugins in a few simple steps.

For example, instead of using a generic dropdown list or radio buttons to give a movie a rating our [Movie Demo plugin](https://github.com/sbarry50/wp-headless-movie-demo) enhances its movie rating field with [the Vue Rate component](https://github.com/SinanMtl/vue-rate).

### 1a. NPM install

Install Vue and Vue Rate via npm

```bash
npm install vue
npm install vue-rate --save
```

### 1b. Third Party CDN

Alternatively if the component is available on a third-party CDN, you may choose to enqueue the package.

We can add config entries for Vue and Vue Rate in the `admin-enqueue.php` config file to achieve this. We will also set the `only_load` parameter to the `movie` post type so they are only loaded on pages the actual Vue component will be used.

```php
    [
        'id'           => 'vue',
        'src'          => 'https://unpkg.com/vue@2.6.9/dist/vue.js',
        'dependencies' => [],
        'version'      => false,
        'in_footer'    => true,
        'only_load' => [
            'post_type' => 'movie'
        ]
    ],
    [
        'id'           => 'vue-rate',
        'src'          => 'https://unpkg.com/vue-rate@2.2.0/dist/vue-rate.js',
        'dependencies' => [],
        'version'      => false,
        'in_footer'    => true,
        'only_load' => [
            'post_type' => 'movie'
        ]
    ]
```

_Note that Vue Rate isn't actually available on a CDN so the source url you see above is invalid._

### 2. Main.js

In `main.js` or whichever file you are using for Vue.

```javascript
import Vue from "vue";
import rate from "vue-rate";

Vue.use(rate);

new Vue({
  el: "#app"
});
```

Note if you are enqueing Vue and the component package via a CDN, you do need to include the `import` and `use` lines above.

Also, don't forget to compile and enqueue your script file.

```bash
npm run dev
npm run production
```

```php
    [
        'id'           => 'main',
        'src'          => SB2Media\MovieDemo\url('dist/js/main.js'),
        'dependencies' => [],
        'version'      => '1.0.0',
        'in_footer'    => true,
        'only_load' => [
            'post_type' => 'movie'
        ]
    ]
```

### 3. Add ID to Meta Box

We need to add the `app` ID to the element we are attaching our component to. In our case this will be to the `movie_details` meta box the component will appear in.

We can achieve this by simply setting a `vue_id` parameter in our meta box configuration if you are using the default `meta-box.php` view template.

```php
    [
        'id'       => 'movie_details',
        'title'    => 'Movie Details',
        'callback' => 'meta-box.php',
        'screen'   => 'movie',
        'context'  => 'normal',
        'priority' => 'high',
        'args'     => [
            'vue_id' => 'app'
        ],
    ]
```

This parameter can also be set in menu and submenu configurations if you want to use Vue components on settings pages.

### 4. View Template

We will need to create a new `rating.php` view template for our component which we will store in `resources/views/fields` folder.

```php
<rate :length='5' name='<?=$args["id"]?>' :value='<?=!empty($args["value"]) ? $args["value"] : 0?>' :ratedesc='<?=json_encode($args["args"]["ratedesc"])?>' />
```

The component accepts length, name, value and rating description props.

- `length` - The number of stars our component will display
- `name` - The ID of our meta field which will be the key stored for this field in the database
- `value` - The field's value from the database. Set to `0` if a value has not been saved yet.
- `ratedesc` - Vue Rate allows optional rating descriptions to be displayed when hovering over the stars by passing an array of descriptions to the `ratedesc` prop. We will set this in the meta field's config.

### 5. Meta Field Configuration

The final piece of the puzzle is setting the `callback` in the meta field's configuration to the view template we created for our component.

```php
    [
        'id'          => 'movie_rating',
        'title'       => 'Movie Rating',
        'description' => 'How would you rate this movie?',
        'callback'    => 'rating.php',
        'meta_box'    => 'movie_details',
        'args'        => [
            'ratedesc' => ['Terrible', 'Bad', 'OK', 'Good', 'Great'],
        ],
        'graphql' => [
            'type' => 'MovieRating',
            'description' => 'Movie rating',
            'resolver' => 'movie-ratings-graphql'
        ]
    ]
```

Note that we also defined the rating description array that we need for the `ratedesc` prop here. Like the rest of the config, it is passed to the `rating.php` template.

### Localization

While this example did not require it, there are times when you need to pass data for Vue components from WordPress to your script file.

Please see the [localization section](/docs/config-enqueue#localization) for information on how to achieve this.
