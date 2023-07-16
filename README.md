### Laravel v.10, Php v.8.2, MariaDB v.10.7.8, Nginx, Redis, Memcached, Rabbitmq

### download the project, installation and configure its launch

1. git clone https://github.com/MyskinD/docker-laravel10.git - клонируем репозиторий
2. заходим в папку проекта
3. sudo chown -R $USER:$USER . - задаем права пользователя на каталог проекта (не root)
4. cp .env.example .env
5. указываем в .env и docker-compose.yml - задаем настройки (название БД, имя пользователя, пароль)
6. добавляем папки в: /environments/mysql/dbdata, /environments/rabbitmq/rmqdata, /environments/redis/redisdata
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

### Install Tailwind CSS

1. npm install -D tailwindcss postcss autoprefixer - устанавливаем пакет с зависимостями
2. npx tailwindcss init -p - генерируем конфигурационные файлы tailwind.config.js и postcss.config.js
3. В этих файлах правим возможный баг: необходимо заменить "export default {" на "module.exports = {"
4. Тот же баг исправить в файле vite.config.js

### Install Vite

NVM (Node Version Manager):

1. sudo apt install build-essential checkinstall libssl-dev - устанавливаем вспомогательные пакеты
2. curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash - устанавливаем пакет
3. source ~/.profile - перезапускаем сессию
4. nvm ls-remote - проверяем работу пакета (показывает все версии node)

NODE:

1. nvm install node - устанавливаем последнюю версию ноды
2. nvm run default --version - версия ноды, установленная по-умолчанию
3. node -v - проверяем версию ноды
4. npm -v - проверяем версию npm
5. npm install -g npm@9.8.0 - при необходимости устанавливаем конкретную версию npm

VITE:

1. npm install && npm run dev - запускаем vite для сервера разработки (development)
2. npm run build - собираем фронт, компилируем js/css из resource в public->build (production)

### install Auth module (при необходимости)

1. docker-compose exec app composer require laravel/breeze --dev - ставим зависимость breeze
2. docker-compose exec app php artisan breeze:install - устанавливаем модуль авторизации (уже установлен)
