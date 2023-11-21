<?php

namespace App\Livewire\Mains;

use App\Livewire\Forms\MainForm;
use App\Livewire\Traits\MainTrait;
use App\Models\INS\Cust;
use App\Models\INS\Main;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use function Laravel\Prompts\alert;


class CreateMains extends Component
{
    use MainTrait;
    public $ShowCustModal = false;
    public $ShowBankModal = false;
    public MainForm $mainform;
    public function Calkst(){
        if ($this->mainform->sul && $this->mainform->kst_count && $this->mainform->kst_count>0) {
            $this->mainform->kst = $this->mainform->sul / $this->mainform->kst_count;
            $this->dispatch('goto', test: 'kst');
        }
    }
    public function chkid()
    {


        $this->dispatch('goto', test: 'accc');
    }
    public function store()
    {
        Config::set('database.connections.other.database', Auth::user()->company);
        info($this->mainform);
        $this->validate();
        $this->mainform->sul_end=$this->EndDate($this->mainform->sul_begin,$this->mainform->kst_count);
        $this->mainform->user_id=Auth::user()->id;

        Main::create(
            $this->mainform->all()
        );

        $this->mainform->reset();
        $this->mainform->id=Main::max('id')+1;
        $this->dispatch('goto', test: 'id');
    }
    public function mount(){
        $this->mainform->id=Main::max('id')+1;
        $this->mainform->sul_begin=date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.mains.create-mains');
    }
}
