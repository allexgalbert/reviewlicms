'use strict';

//событие типа вещание. сообщение тоаст в админку

let nameChannel = 'UnreadMessagesToAdminChannel';
let nameEvent = 'UnreadMessagesToAdminEvent';

window.Echo
  .channel(nameChannel)
  .listen(nameEvent, (event) => {

    //сообщение в виде вёрстки
    //console.log(event.message);

    //вставка сообщения в виде верстки, в контейнер для сообщений
    document.querySelector('.toast-container')
      .insertAdjacentHTML('beforeend', event.message);

    //ищем последнее вставленное сообщение
    var lastMessage = document.querySelector('.toast:last-child');

    //инициализируем его как попап
    new window.bootstrap.Toast(lastMessage).show();
  });
