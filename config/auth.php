<?php

return [

  //по умолчанию
  'defaults' => ['guard' => 'users', 'passwords' => 'users'],

  //гуарды (это драйверы)
  'guards' => [

    //юзеры
    'users' => ['provider' => 'users', 'driver' => 'session'],

    //админы
    'admins' => ['provider' => 'admins', 'driver' => 'session'],

    //api
    //'api' => ['provider' => 'users', 'driver' => 'token', 'hash' => false],
    'api' => ['provider' => 'tokens', 'driver' => 'token', 'hash' => false],
  ],

  //провайдеры это таблицы
  'providers' => [

    //юзеры
    'users' => ['model' => App\Models\User::class, 'driver' => 'eloquent'],

    //админы
    'admins' => ['model' => App\Models\Admin::class, 'driver' => 'eloquent'],

    //токены
    'tokens' => ['model' => App\Models\Token::class, 'driver' => 'eloquent'],
  ],

  //сброс пароля
  'passwords' => [

    //юзеры
    'users' => ['provider' => 'users', 'table' => 'password_resets', 'expire' => 60, 'throttle' => 60],

    //админы
    'admins' => ['provider' => 'admins', 'table' => 'password_resets', 'expire' => 60, 'throttle' => 60],

    //токены
    'tokens' => ['provider' => 'tokens', 'table' => 'password_resets', 'expire' => 60, 'throttle' => 60],
  ],

  //время жизни подтверждения пароля на важных страницах
  'password_timeout' => 10800,
];
