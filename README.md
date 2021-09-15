<p align="center">
<img src="https://miro.medium.com/max/1298/1*6bdJkpREgbNCtvQ4zFmcGg.png" width="600">
</p>


## Laravel + React


### 1. Создаем новый проект `lara.react.loc`

    composer create-project laravel/laravel lara.react.loc

### 2. Добавляем первичных настроек работы с react нам нужен пакет 

    composer requere laravel/ui

### 3. Обновляем node

Хотя бы до 12.12

### 4. Запускаем установку пакетов node.js

    npm i

### 5. Запускаем сборку

    npm run dev

### 6. Запускаем создание авторизацию на vue + инициализацию работы с React

    php artisan ui react --auth

Флаг `--auth` создаст файлы (контроллеры/blade) авторизации + пропишет нужные роуты.


[тут подробней](https://laravel.com/docs/7.x/frontend)

------

Кроме этого будут внесены изменения для фронта
- создан пример компонента на React `resources/js/components/Example.js`
```js     
import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                Тут контент
            </div>
        </div>
    );
}

export default Example;
```

и в этом же файле ниже его инициализация

```js
if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
```

- подключен экземпляр в `resources/js/app.js`

 ```js     
 require('./components/Example');
 ```

- добавлены следующие пакеты npm
  - @babel/preset-react
  - bootstrap
  - jquery
  - popper.js
  - react
  - react-dom
  - sass
  - sass-loader

- подключены в `resources/js/bootstrap.js`
```js
try {
  window.Popper = require('popper.js').default;
  window.$ = window.jQuery = require('jquery');
    
  require('bootstrap');
} catch (e) { }
```


### 7. Запускаем сборку

    npm run watch-poll

### 8. Подключаем скрипты и компоненты на страницы

Далее нам надо подключить все скрипты и стили в шаблоне Blade

```html
<script src="{{ asset('js/app.js') }}" defer></script>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
```

и в нужных места добавлять теги с ID для подключения компонента
```html
<div id="example"></div>
```
