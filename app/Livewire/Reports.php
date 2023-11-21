<?php

namespace App\Livewire;

use Livewire\Component;

class Reports extends Component
{
  public $Rep;
  public function mount ($rep)
  {

    $this->Rep=$rep;

  }
    public function render()
    {
        return view('livewire.reports');
    }
}
