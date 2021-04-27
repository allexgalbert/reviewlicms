//подключаем библиотеку Lodash
window._ = require('lodash');

//подключаем библиотеку Axios
window.axios = require('axios');

//настройка Axios
window.axios
  .defaults
  .headers
  .common['X-Requested-With'] = 'XMLHttpRequest';

//подключаем библиотеку laravel Echo
import Echo from 'laravel-echo';

//подключаем библиотеку Pusher
window.Pusher = require('pusher-js');

//настройка laravel Echo
window.Echo = new Echo({

  //вещатель
  broadcaster: 'pusher',

  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,

  //новое добавил
  wsHost: window.location.hostname,
  wsPort: 6001,
  //wssPort: 6001,

  //true для работы с SSL
  forceTLS: false,

  //отключить отправку статистики в сервис Pusher
  disableStats: true,

  //урл аутентификации
  //authEndpoint: '/guard/auth/broadcasting1',
});