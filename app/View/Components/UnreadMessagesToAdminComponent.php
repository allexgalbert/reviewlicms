<?php

//событие типа вещание. сообщение тоаст в админку

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class UnreadMessagesToAdminComponent extends Component {

  //<x-unreadmessagestoadmincomponent/>
  public function render() {

    //на странице чата не отображаем тоасты
    if (!Request::routeIs('backend.messages.index')) {
      return view('backend.global.toastContainer');
    }

  }
}
