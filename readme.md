# Как развернуть у себя проект ?
1. `git clone git@git.adbakers.com.ua:Unilever/black-pearl.git`
2. Запустить локальную машину
2. Установить все зависимости `composer install`
3. Сгенерировать ключ `php artisan key:generate`
4. Запустить миграции для создания структуры БД `php artisan migrate`
5. Добавить в БД информацию `php artisan db:seed`

## Полезные команды
- Удаление всех таблиц. `php artisan migrate:rollback` : полезно, в случае, если нужно затереть информацию в БД или когда добавлены новые миграции на сайте. После этой директивы, как правило, стоит использовать `php artisan migrate`
- Создание структуры и добавление в БД информации одной командой `php artisan migrate --seed` . 