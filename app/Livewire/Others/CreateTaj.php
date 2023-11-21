<?php

namespace App\Livewire\Others;

use App\Livewire\Forms\BankForm;
use App\Livewire\Forms\TajForm;
use App\Models\INS\Bank;
use App\Models\INS\Taj;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CreateTaj extends Component
{
    use WithPagination;
    public TajForm $tajform;
    public $Mod='inp';
    public $taj_id;


    public function sortBy($field){

    }
    public function Edit(Taj $tajform){
        $this->Mod='upd';
        $this->taj_id=$tajform->id;
        $this->tajform->taj_name=$tajform->bank_name;
        $this->tajform->taj_acc=$tajform->taj_acc;
        $this->tajform->user_id=Auth::user()->id;
    }
    public function cancel(){
        $this->Mod='inp';
        $this->tajform->reset();
        $this->dispatch('goto', test: 'taj_name');

    }
    public function Delete($id){

    }
    public function store(){
        $this->validate();
        if ($this->Mod=='inp'){
            $this->tajform->user_id=Auth::user()->id;
            Taj::create(
                $this->tajform->all()
            );
        }
        if ($this->Mod=='upd'){

            Taj::where('id',$this->taj_id)->update(
                $this->tajform->all()
            );
            $this->Mod='inp';
        }

        $this->tajform->reset();
        $this->dispatch('goto', test: 'taj_name');
    }

    public function render()
    {
        return view('livewire.others.create-taj',[
            'Table'=>Taj::paginate(10),
        ]);
    }
}
