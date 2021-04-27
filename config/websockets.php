<?php

use BeyondCode\LaravelWebSockets\Dashboard\Http\Middleware\Authorize;

return [

  //порт
  'dashboard' => [
    'port' => env('LARAVEL_WEBSOCKETS_PORT', 6001),
  ],

  'apps' => [
    [
      'id' => env('PUSHER_APP_ID'),
      'name' => env('APP_NAME'),
      'key' => env('PUSHER_APP_KEY'),
      'secret' => env('PUSHER_APP_SECRET'),
      'path' => env('PUSHER_APP_PATH'),
      'capacity' => null,

      //исправили с false на true
      'enable_client_messages' => true,

      'enable_statistics' => true,
    ],
  ],

  'app_provider' => BeyondCode\LaravelWebSockets\Apps\ConfigAppProvider::class,

  //список хостов с которых принимать входящие запросы. если пусто то с любых хостов
  'allowed_origins' => [
  ],

  //максимальный размер входящего запроса в Кб
  'max_request_size_in_kb' => 250,

  //путь для регистрации роутов
  'path' => 'ru/laravel-websockets',

  //список МВ для роутов панели отладки
  'middleware' => [
    'web',
    Authorize::class,
  ],

  'statistics' => [

    //модель для хранения статистики
    'model' => \BeyondCode\LaravelWebSockets\Statistics\Models\WebSocketsStatisticsEntry::class,

    //логгер статистики
    'logger' => BeyondCode\LaravelWebSockets\Statistics\Logger\HttpStatisticsLogger::class,

    //статистика логируется каждые N секунд
    'interval_in_seconds' => 60,

    //команда удаления статистики удалит статистику за N дней
    'delete_statistics_older_than_days' => 60,

    //использовать DNS резолвер для запросов к логгеру статистики
    'perform_dns_lookup' => false,
  ],

  //настроить SSL http://php.net/manual/en/context.ssl.php
  'ssl' => [

    //путь до сертификата PEM
    'local_cert' => env('LARAVEL_WEBSOCKETS_SSL_LOCAL_CERT', null),

    //путь до приватного ключа
    'local_pk' => env('LARAVEL_WEBSOCKETS_SSL_LOCAL_PK', null),

    //пароль для приватного ключа
    'passphrase' => env('LARAVEL_WEBSOCKETS_SSL_PASSPHRASE', null),
  ],

  //как обрабатывать каналы присутствия
  'channel_manager' => \BeyondCode\LaravelWebSockets\WebSockets\Channels\ChannelManagers\ArrayChannelManager::class,
];
