---
title: Event Manager
description: Guide to using the events manager
extends: _layouts.documentation
section: content
---

## Event Manager

WP Headless extends [DownShift's WordPress event emitter](https://github.com/downshiftorg/wp-event-emitter) with a [event manager wrapper](https://torquemag.io/2017/10/using-pimple-service-container-wordpress-development/).

Adding actions and filters is very similar to working with WordPress' native hook system API.

```php
use SB2Media\Headless\Events\EventManager;

...

EventManager::addAction('event-hook', [$this, 'callbackMethod'], $priority_num, $accepted_args_num);
EventManager::addFilter('filter-name', [$this, 'callbackMethod'], $priority_num, $accepted_args_num);
```

Events can also be removed with the `removeAction()` method.

```php
EventManager::removeAction('event-hook', [$this, 'callbackMethod'], $priority_num, $accepted_args_num);
```
