'use strict';

document.querySelector('.delete')
  .addEventListener('click', (event) => {
    if (!confirm('Удалить?')) {
      event.preventDefault();
    }
  });
