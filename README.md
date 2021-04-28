<p align="center">
<img src="https://raw.githubusercontent.com/allexgalbert/reviewlicms/master/DOC/fullLogo.png" width="400">
</p>

# Reviewli CMS

- Быстрая и простая CMS с открытым исходным кодом
- Немного похожа на Trustpilot или Tripadvisor
- Предназначена для создания каталога сайтов с отзывами о них

## Требования

- PHP 7.4+
- Laravel 8.12+
- MySQL 8.0+

## Установка

```sh
composer create-project --stability=dev allexgalbert/reviewlicms
```

## Содержание

- [Фронтенд](#фронтенд)
- [Мультиязычность](#мультиязычность)
- [Личный кабинет клиента](#личный-кабинет-клиента)
- [Личный кабинет администратора](#личный-кабинет-администратора)
- [Особенности](#особенности)
- [Использование](#использование)

### Фронтенд

- Главная страница
- Велком-попап при первом входе
- Каталог с фильтрами по категориям, брендам, особенностям
- Выбор языков в меню
- Каждый сайт имеет свою страницу с фото, урлом, отзывами, рейтингом

### Мультиязычность

- Автоматическое определение локали и языка браузера пользователя
- Если язык в списке есть, то сайт показывается на нём, иначе на английском
- Установка языка в урл /lang/ для всех ссылок
- Подгрузка файлов сообщений из языковых папок
- Установлено 4 языка, с возможностью быстрого добавления других языков

### Личный кабинет клиента

- Страница регистрации, входа, восстановления пароля
- Страница входа с галкой "Запомнить меня"
- Отправка писем пользователю
- Страница Чата с администратором, с попапами и количеством непрочитанных сообщений
- Страница Профиль со сменой имени
- Страница Отзывы клиента с оценками

### Личный кабинет администратора

- Страница входа
- Страница Категорий: создать, изменить, удалить, найти
- Страница Брендов: создать, изменить, удалить, найти
- Страница Особенностей: создать, изменить, удалить, найти
- Страница Сайтов: создать, изменить, удалить
- Страница Пользователей: изменить, забанить, запретить отзывы, автологин, предупреждения, чат
- Страница Отзывов: изменить, удалить
- Страница Администраторов: изменить, удалить

### Особенности

- Чат между пользователем и администратором на вебсокетах
- Одновременный вход пользователем и администратором

### Использование

[YouTube](https://www.youtube.com/)

## Лицензия

Reviewli CMS это программное обеспечение с открытым исходным кодом, лицензируемое
по [MIT лицензии](https://opensource.org/licenses/MIT).
