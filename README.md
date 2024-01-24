# Real Estate Management

1. Запуск в контейнеров Docker:
> docker compose up -d

2. Остановка контейнеров

> docker compose down

3. Импорт дампа базы данных (выполнять внутри контейнера mysql)

>mysqldump -uroot -psecret wp_test < dump.sql
 
Если настраивать без докера то DOCUMENT_ROOT указать на папку "app"