'use strict';

let nameChannel = 'ChatChannel.' + document.querySelector('form input[name=user_id]').value;
let nameEvent = 'ChatEvent';
let listenForWhisper = document.querySelector('#listenForWhisper');
let messageInput = document.querySelector('input[name=message]');

//событие типа вещание. сообщение в чат админу
window.Echo
  .private(nameChannel)
  .listen(nameEvent, (event) => {
    insertMessage(event.message);
  });
//-------------------------------------------------

//создать событие "админ печатает..."
messageInput.addEventListener('keypress', (event) => {
  setTimeout(() => {
    window.Echo.private(nameChannel).whisper('typing', {adminTyping: true})
  }, 500)
});

//ловим событие "юзер печатает..."
window.Echo.private(nameChannel)
  .listenForWhisper('typing', (event) => {
    if (event.userTyping) {
      listenForWhisper.style.visibility = 'visible';
    }
  });

//очистим текст "юзер печатает..."
setInterval(function () {
  listenForWhisper.style.visibility = 'hidden';
}, 500);
//-------------------------------------------------

//вставка сообщения
function insertMessage(message) {

  //вставка
  document.getElementById('messages').insertAdjacentHTML('beforeend', message);

  chatScrollDown();
}

//enter на поле
document.querySelector('input[name=message]').addEventListener('keypress', (event) => {
  if (event.keyCode === 13) {
    MessageController_update(event);
  }
});

//клик на кнопку
document.querySelector('button[type=submit]').addEventListener('click', (event) => {
  MessageController_update(event);
});


//создать сообщение
function MessageController_update(event) {

  event.preventDefault();

  //форма
  let form = new FormData(document.querySelector('form'));

  //поля формы
  var fields = {};
  form.forEach(function (value, key) {
    fields[key] = value;
  });

  window.axios.post(
    '/ru/backend/messages/' + document.querySelector('form input[name=user_id]').value,
    fields
  ).then(function (response) {
    insertMessage(response.data);
    document.querySelector('form input[name=message]').value = '';
  }).catch(function (error) {
    alert(error);
  });
}

window.addEventListener('load', function () {
  chatScrollDown();
});

//скролл чата вниз
function chatScrollDown() {
  //чат
  var chat = document.getElementById('messages');
  //скролл вниз
  chat.scrollTop = chat.scrollHeight;
}
