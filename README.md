# CakePHP AdminLTE Theme

forked from maiconpinto/cakephp-adminlte-theme

## Installation

You can install using [composer](http://getcomposer.org).

```
composer require alisson-nascimento/cakephp-theme-adminlte
```

### Enable Plugin

    $ bin/cake plugin load AdminLTE

### Enable theme

```php
// src/Controller/AppController.php

public function beforeRender(Event $event)
{
    $this->viewBuilder()->setTheme('AdminLTE');
}
```

### Enable Form

```php
// src/View/AppView.php

public function initialize()
{
    $this->loadHelper('Form', ['className' => 'AdminLTE.Form']);
}
```

### Configure

```php
// To customize configuration paste it at end of method initialize in src/Controller/AppController.php

Configure::write('Theme', [
    'title' => 'AdminLTE',
    'logo' => [
        'mini' => '<b>A</b>LT',
        'large' => '<b>Admin</b>LTE'
    ],
    'login' => [
        'show_remember' => true,
        'show_register' => true,
        'show_social' => true
    ],
    'folder' => ROOT,
    'skin' => 'blue' // default is 'blue'
]);
```

### Customize Layout

If you want to [Customize Layout](https://github.com/maiconpinto/cakephp-adminlte-theme/wiki/Customize-Layout)

### Page debug

Added link to default page of CakePHP.

![Page debug](docs/page-debug.png)
