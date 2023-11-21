<?php

namespace App\Livewire\Others;

use App\Livewire\Forms\CustForm;
use App\Models\INS\Cust;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCusts extends Component
{
 use WithPagination;
    public CustForm $custForm;
    public $Mod='inp';
    public $cust_id;

    public function sortBy($field){

    }
    public function Edit(Cust $custrec){
       $this->Mod='upd';

       $this->custForm->SetCust($custrec);

       $this->cust_id=$custrec->id;
    }
    public function cancel(){
        $this->Mod='inp';
        $this->custForm->reset();
        $this->dispatch('goto', test: 'cust_name');
    }
    public function Delete($id){

    }
    public function store(){
        $this->validate();
        if ($this->Mod=='inp'){
            $this->custForm->user_id=Auth::user()->id;
            Cust::create(
                $this->custForm->all()
            );
        }
        if ($this->Mod=='upd'){

            Cust::where('id',$this->cust_id)->update(
                $this->custForm->all()
            );
            $this->Mod='inp';
        }

        $this->custForm->reset();
        $this->dispatch('goto', test: 'cust_name');
    }
    public function mount(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.others.create-custs',[
            'Table'=>Cust::latest()->paginate(10),
        ]);
    }
}
