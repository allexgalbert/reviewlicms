const mix = require('laravel-mix');

//главные файлы

mix.sass('resources/sass/app.scss', 'public/css/app.css').version();
mix.js('resources/js/app.js', 'public/js/app.js').version();
//-------------------------------------------------

//backend

mix.js('resources/js/backend/brands.js', 'public/js/backend/brands.js').version();
mix.js('resources/js/backend/categories.js', 'public/js/backend/categories.js').version();
mix.js('resources/js/backend/features.js', 'public/js/backend/features.js').version();
mix.js('resources/js/backend/sites.js', 'public/js/backend/sites.js').version();
mix.js('resources/js/backend/users.js', 'public/js/backend/users.js').version();
mix.js('resources/js/backend/reviews.js', 'public/js/backend/reviews.js').version();
mix.js('resources/js/backend/admins.js', 'public/js/backend/admins.js').version();
mix.js('resources/js/backend/messages.js', 'public/js/backend/messages.js').version();

//событие типа вещание. сообщение тоаст в админку
mix.js('resources/js/backend/global/toast.js', 'public/js/backend/global/toast.js').version();
//-------------------------------------------------

//frontend

mix.js('resources/js/frontend/home.js', 'public/js/frontend/home.js').version();

//событие типа вещание. сообщение тоаст в юзерку
mix.js('resources/js/frontend/global/toast.js', 'public/js/frontend/global/toast.js').version();

//попап WelcomeModalComponent
mix.js('resources/js/frontend/global/modal.js', 'public/js/frontend/global/modal.js').version();
//-------------------------------------------------

//user
mix.js('resources/js/user/chat.js', 'public/js/user/chat.js').version();
mix.js('resources/js/user/profile.js', 'public/js/user/profile.js').version();
