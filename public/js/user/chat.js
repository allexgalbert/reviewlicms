/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/user/chat.js":
/*!***********************************!*\
  !*** ./resources/js/user/chat.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var nameChannel = 'ChatChannel.' + document.querySelector('form input[name=user_id]').value;
var nameEvent = 'ChatEvent';
var listenForWhisper = document.querySelector('#listenForWhisper');
var messageInput = document.querySelector('input[name=message]'); //событие типа вещание. сообщение в чат юзеру

window.Echo["private"](nameChannel).listen(nameEvent, function (event) {
  insertMessage(event.message);
}); //-------------------------------------------------
//создать событие "юзер печатает..."

messageInput.addEventListener('keypress', function (event) {
  setTimeout(function () {
    window.Echo["private"](nameChannel).whisper('typing', {
      userTyping: true
    });
  }, 500);
}); //ловим событие "админ печатает..."

window.Echo["private"](nameChannel).listenForWhisper('typing', function (event) {
  if (event.adminTyping) {
    listenForWhisper.style.visibility = 'visible';
  }
}); //очистим текст "админ печатает..."

setInterval(function () {
  listenForWhisper.style.visibility = 'hidden';
}, 500); //-------------------------------------------------
//вставка сообщения

function insertMessage(message) {
  //вставка
  document.getElementById('chat').insertAdjacentHTML('beforeend', message);
  chatScrollDown();
} //enter на поле


document.querySelector('input[name=message]').addEventListener('keypress', function (event) {
  if (event.keyCode === 13) {
    ChatController_update(event);
  }
}); //клик на кнопку

document.querySelector('button[type=submit]').addEventListener('click', function (event) {
  ChatController_update(event);
}); //блок ошибок

function errorBlock1() {
  return document.querySelector('#error');
} //создать сообщение


function ChatController_update(event) {
  event.preventDefault(); //блок ошибок

  var errorBlock = errorBlock1(); //делаем блок невидимым

  errorBlock.classList.add('d-none'); //очистим блок

  errorBlock.innerHTML = ''; //форма

  var form = new FormData(document.querySelector('form')); //поля формы

  var fields = {};
  form.forEach(function (value, key) {
    fields[key] = value;
  }); //запрос

  window.axios.post('/ru/user/chat', fields).then(function (response) {
    //вставка сообщения
    insertMessage(response.data); //очистка поля ввода

    document.querySelector('form input[name=message]').value = '';
  })["catch"](function (error) {
    //делаем блок видимым
    errorBlock.classList.remove('d-none'); //ошибки

    var errorsList = error.response.data.errors; //перебор ошибок

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
}); //скролл чата вниз

function chatScrollDown() {
  //чат
  var chat = document.getElementById('chat'); //скролл вниз

  chat.scrollTop = chat.scrollHeight;
}

/***/ }),

/***/ 13:
/*!*****************************************!*\
  !*** multi ./resources/js/user/chat.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\u\Desktop\laravel\domains\400.loc\resources\js\user\chat.js */"./resources/js/user/chat.js");


/***/ })

/******/ });