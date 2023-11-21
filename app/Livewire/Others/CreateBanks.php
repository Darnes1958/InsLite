<?php

namespace App\Livewire\Others;

use App\Livewire\Forms\BankForm;
use App\Models\INS\Bank;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBanks extends Component
{
    use WithPagination;
    public BankForm $bankform;
    public $Mod='inp';
    public $bank_id;
    public $ShowTajModal=false;
    public $BankChange=0;
    public $custumer;
    public function updatedBankChange(){
        $this->BankChange=0;
        $this->dispatch('goto', test: 'bankstore');
    }

    public function sortBy($field){

    }

    public function Edit(Bank $bankform){
        $this->Mod='upd';
        $this->bank_id=$bankform->id;
        $this->bankform->bank_name=$bankform->bank_name;
        $this->bankform->taj_id=$bankform->taj_id;
        $this->bankform->user_id=Auth::user()->id;
    }
    public function cancel(){
        $this->Mod='inp';
        $this->bankform->reset();
        $this->dispatch('goto', test: 'bank_name');

    }
    public function Delete($id){

    }
    public function store(){
        $this->validate();
        if ($this->Mod=='inp'){
            $this->bankform->user_id=Auth::user()->id;
            Bank::create(
                $this->bankform->all()
            );
        }
        if ($this->Mod=='upd'){

            Bank::where('id',$this->bank_id)->update(
                $this->bankform->all()
            );
            $this->Mod='inp';
        }

        $this->bankform->reset();
        $this->dispatch('goto', test: 'bank_name');
    }
    public function render()
    {

        return view('livewire.others.create-banks',[
            'Table'=>Bank::paginate(10),
        ]);
    }
}
