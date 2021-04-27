<?php

return [

  //драйвер по умолчанию
  'default' => env('MAIL_MAILER', 'smtp'),

  //драйверы
  'mailers' => [

    'smtp' => [
      'transport' => 'smtp',
      'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
      'port' => env('MAIL_PORT', 587),
      'encryption' => env('MAIL_ENCRYPTION', 'tls'),
      'username' => env('MAIL_USERNAME'),
      'password' => env('MAIL_PASSWORD'),
      'timeout' => null,
      'auth_mode' => null,
    ],

    //Amazon SES
    'ses' => [
      'transport' => 'ses',
    ],

    'mailgun' => [
      'transport' => 'mailgun',
    ],

    'postmark' => [
      'transport' => 'postmark',
    ],

    'sendmail' => [
      'transport' => 'sendmail',
      'path' => '/usr/sbin/sendmail -bs',
    ],

    'log' => [
      'transport' => 'log',
      'channel' => env('MAIL_LOG_CHANNEL'),
    ],

    'array' => [
      'transport' => 'array',
    ],
  ],

  //заголовок From
  'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Example'),
  ],

  //заголовок reply_to
  'reply_to' => [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Example'),
  ],

  //дизайн писем markdown
  'markdown' => [
    'theme' => 'default',

    'paths' => [
      resource_path('views/vendor/mail'),
    ],

  ],

];
