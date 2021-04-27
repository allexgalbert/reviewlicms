<?php

//попап CountUnreadMessagesUsercomponent

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CountUnreadMessagesUsercomponent extends Component {

  public function __construct() {
  }

  //<x-countunreadmessagesusercomponent/>
  public function render() {

    if ($user = Auth::guard('users')->user()) {
      if ($user->unreadmessages_touser) {
        return view('components.modal', [
          'header' => 'непрочитанные сообщения',
          'body' => 'сообщений: ' . $user->unreadmessages_touser,
        ]);
      }
    }

  }
}
