### Laravel v.10, Php v.8.2, MariaDB v.10.7.8, Nginx, Redis, Memcached, Rabbitmq

### download the project, installation and configure its launch

1. git clone https://github.com/MyskinD/docker-laravel10.git - клонируем репозиторий
2. заходим в папку проекта
3. sudo chown -R $USER:$USER . - задаем права пользователя на каталог проекта (не root)
4. cp .env.example .env
5. указываем в .env и docker-compose.yml - задаем настройки (название БД, имя пользователя, пароль)
6. добавляем папки в: /environments/mysql/dbdata, /environments/rabbitmq/rmqdata, /environments/redis
7. sudo docker-compose up -d - поднимаем контейнеры
8. docker-compose exec app composer install - подтягиваем зависимости
9. docker-compose exec app php artisan key:generate - генерируем ключ
10. docker-compose exec app php artisan config:cache - кэшируем настройки (при необходимости)
11. в /etc/hosts и /<папка проекта>/nginx/conf.d/app.conf указываем имя сервера

### creating a user in the database and giving them rights to it

1. docker-compose exec db bash - создаем пользователя mysql
2. mysql -u root -p - ввозим пароль рута, указанного в docker-compose.yml
3. show databases; - проверяем существование БД
4. CREATE USER 'user'@'localhost' IDENTIFIED BY '123654'; - создаем пользователя по данным из .env
5. GRANT ALL ON laravel.* TO 'user'@'%' IDENTIFIED BY '123654'; - задаем права на указанную базу
6. FLUSH PRIVILEGES; - применяем новые права пользователя
7. SHOW GRANTS FOR user@localhost; - проверяем назначенные права пользователю
8.  exit - выходим из БД и контейнера
9.  docker-compose exec app php artisan migrate - запускаем миграции

### check the operation of the database

1. docker-compose exec app php artisan tinker - запускаем tinker для проверки работоспособности БД
2. \DB::table('migrations')->get(); - выводит все строки в табилце
3. exit - выходим

### install Auth module (при необходимости)

1. docker-compose exec app npm install - устанавливаем Laravel Mix
2. composer require laravel/breeze --dev - ставим зависимость breeze
3. docker-compose exec app php artisan breeze:install - устанавливаем модуль авторизации (уже установлен)
4. docker-compose exec app npm run dev - компилируем js/css из resource в public
5. docker-compose exec app php artisan migrate - запускаем миграции
