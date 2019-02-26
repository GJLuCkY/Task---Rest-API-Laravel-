
# REST API на php фреймворке - Laravel 5.7


# Суть задачи:

Написать небольшой rest-api сервис для работы с пользователями на php фреймворке.

База данных должна содержать таблицы:
  - **users** - id, email, phone, status 
  - **users_data**  - id, user_id, name, surname, gender, town_id
  - **towns** - id, name, translit_name

Методы для API:
  - **GET /users** - возвращает список пользователей; 
  - **GET /user/{id-пользователя}**  - возвращает объект пользователя со всеми атрибутами (из таблиц  users, users_data, и поля towns.name, towns.translit_name);
- **POST /user** - создание пользователя, параметры запроса: name, 
surname, email, phone;
- **GET /users/count** - кол-во всех пользователей
- **GET /towns** - список всех городов

# Требования
Приложение должно работать без ошибок;



# Установка

  - git clone https://github.com/GJLuCkY/Task---Rest-API-Laravel-.git .
  - cd project-folder
  - composer install
  - create database
  - cp .env.example .env
  - php artisan key:generate
  - set DB
  - php artisan migrate
  - php artisan db:seed --class=TownsTableSeeder
  - php artisan db:seed --class=UsersTableSeeder


