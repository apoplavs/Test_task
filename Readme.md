<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

### Вимоги

  - PHP >=7.1
  - MySQL >=5.0
  - Composer >=1.6

### Встановлення

Спочатку потрібно скачати проект і встановити всі необхідні залежності

```sh
$ git clone https://github.com/apoplavs/test_task.git
$ cd test_task
$ cp .env.example .env
$ composer install
$ php artisan key:generate
```

Потрібно створити БД для проекту і встановити налаштування доступу до цієї БД в файлі `.env `

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

і виконати міграції

```sh
$ php artisan migrate
```
Проект готовий до запуску. Для запуску в локальному середовищі потрібно виконати

```sh
$ php artisan serve
```
