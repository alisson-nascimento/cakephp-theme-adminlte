# CakePHP AdminLTE Theme

Este projeto é um fork de maiconpinto/cakephp-adminlte-theme

## Instalação

Você pode instalar usando o [composer](http://getcomposer.org).

```
composer require alisson-nascimento/cakephp-theme-adminlte
```

### Habilitar Plugin

```
$ bin/cake plugin load AdminLTE
```

### Habilitar Theme

```php
// src/Controller/AppController.php

public function beforeRender(Event $event)
{
    $this->viewBuilder()->setTheme('AdminLTE');
}
```

### Habilitar Form

```php
// src/View/AppView.php

public function initialize()
{
    $this->loadHelper('Form', ['className' => 'AdminLTE.Form']);
}
```

### Configuração

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

### Customizar Layout

[Customize Layout](https://github.com/maiconpinto/cakephp-adminlte-theme/wiki/Customize-Layout)

### Página de debug

Added link to default page of CakePHP.

![Page debug](docs/page-debug.png)
