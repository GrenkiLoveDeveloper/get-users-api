# API для работы с пользователями, построенный на Laravel, Docker и MySQL

# Описание
Тестовый проект

Структура проекта выглядит примерно так:
├── api (backend) Laravel 11
├── docker
└── остальные файлы докера (docker-compose, .dockerignore, aliases, Makefile)

1. Создайте на основе .env.example .env файл в папке api
2. Запустите докер и запустите из корня проекта командами из Makefile

```
make build

make up
```

или обычными командами

```
docker compose --env-file ./api/.env build --no-cache
docker compose --env-file ./api/.env up -d
``

После запуска контейнеров, должны отработать миграции автоматически, если перейти в логи контейнера php, то должна быть информация о том что они отработали это займет какое-то время возможно

3. Убедитесь, что проект запустился Lara будет крутится на http://localhost:8000/ по умолчанию

4. Вы можете запустить Seedеrs из php контейнера, командой, будут созданы пользователи с данными

```
php artisan db:seed --class=UserSeeder
```

5. Так же воспользоваться постманом

например сделать поиск, с сортировкой

```
http://127.0.0.1:8000/api/users?name=John&sort[by]=name&sort[order]=asc&page=1
```

или создать пользователя через POST

```
http://127.0.0.1:8000/api/users
```

При этом вставить в body к примеру

```
 {
  "name": "John Doe",
  "ip": "190.155.0.0",
  "comment": "Создаем комментарий к пользователю",
  "password": "super123",
  "email": "test@yandex.ru"
}
```

итд.