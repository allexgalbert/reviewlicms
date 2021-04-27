<?php

//событие типа вещание. сообщение тоаст в юзерку

namespace App\View\Components;

use Illuminate\View\Component;

class UnreadMessagesToUserComponent extends Component {

  //<x-countunreadmessagesusercomponent/>
  public function render() {
    return view('frontend.global.toastContainer');
  }
}
