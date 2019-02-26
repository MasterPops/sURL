0. Клонировать репозиторий:

$ git clone https://github.com/MasterPops/sURL.git

1. Перейти в папку с проектом

$ cd sURL

2. Запустить контейнеры Docker

$ docker-compose up

..(При возникновении ошибки загрузки composer - повторить команду, предварительно удалив образы:

..$ docker images -a - вывести список образов

..$ docker rmi -f <images_id> - Удалить образ)

3. API доступно по адресу http://127.0.0.1:88

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


Генерация сокращенной ссылки происходит на основе id записи в БД. id приводится к 62-системе счисления с использованием библиотеки gmp. Это позволяет генерировать ссылки с  прописным и строчными буквами алфавита и цифрами.
Логи пишутся в БД в таблицу logs. Процессы запускаются в разных docker-контейнерах. Один процесс - один контейнер.

masterpops.96@gmail.com
