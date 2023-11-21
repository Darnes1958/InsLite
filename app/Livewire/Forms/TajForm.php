<?php
namespace App\Livewire\Forms;


use Livewire\Attributes\Rule;
use Livewire\Form;


class TajForm extends Form
{
    #[Rule('required',message: 'يجب ادخال الاسم')]
    public $taj_name = '';
    public $taj_acc = '';
    public $user_id='';


}

