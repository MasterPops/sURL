0. Клонировать репозиторий:

$ git clone https://github.com/MasterPops/sURL.git

1. Перейти в папку с проектом

$ cd sURL

2. Запустить контейнеры Docker

$ docker-compose up

(При возникновении ошибок установки каких-либо компонентов - повторить команду, предварительно удалив контейнеры)

3. APP доступно по адресу http://127.0.0.1:88

4. PhpMyAdmin доступен по адресу http://127.0.0.1:8080

5. SwaggerUI - http://127.0.0.1:88/api/documentation

6. Запуск тестов:

-Выполнить:

$ docker ps

-Скопировать id контейнера laravel_app

-Выполнить:

$ docker exec -it <container_id> bash

-Выполнить:

$ vendor/bin/phpunit
