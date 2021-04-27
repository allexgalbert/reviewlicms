<?php

//попап WelcomeModalComponent

namespace App\View\Components;

use Illuminate\View\Component;

class WelcomeModalComponent extends Component {

  public function __construct() {
  }

  //<x-welcomemodalcomponent/>
  public function render() {

    if (empty(session('welcomemodalcomponent'))) {

      session(['welcomemodalcomponent' => 1]);

      return view('components.modal', [
        'header' => 'welcome',
        'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
      ]);

    }

  }
}
