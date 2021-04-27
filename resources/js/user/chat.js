'use strict';

let nameChannel = 'ChatChannel.' + document.querySelector('form input[name=user_id]').value;
let nameEvent = 'ChatEvent';
let listenForWhisper = document.querySelector('#listenForWhisper');
let messageInput = document.querySelector('input[name=message]');

//событие типа вещание. сообщение в чат юзеру
window.Echo
  .private(nameChannel)
  .listen(nameEvent, (event) => {
    insertMessage(event.message);
  });
//-------------------------------------------------

//создать событие "юзер печатает..."
messageInput.addEventListener('keypress', (event) => {
  setTimeout(() => {
    window.Echo.private(nameChannel).whisper('typing', {userTyping: true})
  }, 500)
});

//ловим событие "админ печатает..."
window.Echo.private(nameChannel)
  .listenForWhisper('typing', (event) => {
    if (event.adminTyping) {
      listenForWhisper.style.visibility = 'visible';
    }
  });

//очистим текст "админ печатает..."
setInterval(function () {
  listenForWhisper.style.visibility = 'hidden';
}, 500);
//-------------------------------------------------

//вставка сообщения
function insertMessage(message) {

  //вставка
  document.getElementById('chat').insertAdjacentHTML('beforeend', message);

  chatScrollDown();
}

//enter на поле
document.querySelector('input[name=message]').addEventListener('keypress', (event) => {
  if (event.keyCode === 13) {
    ChatController_update(event);
  }
});

//клик на кнопку
document.querySelector('button[type=submit]').addEventListener('click', (event) => {
  ChatController_update(event);
});

//блок ошибок
function errorBlock1() {
  return document.querySelector('#error');
}


//создать сообщение
function ChatController_update(event) {

  event.preventDefault();

  //блок ошибок
  var errorBlock = errorBlock1();

  //делаем блок невидимым
  errorBlock.classList.add('d-none');

  //очистим блок
  errorBlock.innerHTML = '';

  //форма
  let form = new FormData(document.querySelector('form'));

  //поля формы
  var fields = {};
  form.forEach(function (value, key) {
    fields[key] = value;
  });

  //запрос
  window.axios.post('/ru/user/chat',
    fields
  ).then(function (response) {

    //вставка сообщения
    insertMessage(response.data);

    //очистка поля ввода
    document.querySelector('form input[name=message]').value = '';

  }).catch(function (error) {

    //делаем блок видимым
    errorBlock.classList.remove('d-none');

    //ошибки
    var errorsList = error.response.data.errors;

    //перебор ошибок
    for (var key in errorsList) {

      //вставляем ошибки
      errorsList[key].forEach(function (item, i, arr) {
        errorBlock.insertAdjacentHTML('beforeend', '<p>' + item + '</p>');
      });

    }

  });
}

window.addEventListener('load', function () {
  chatScrollDown();
});

//скролл чата вниз
function chatScrollDown() {
  //чат
  var chat = document.getElementById('chat');
  //скролл вниз
  chat.scrollTop = chat.scrollHeight;
}
