<?php

namespace App\Livewire\Report;

use App\Models\INS\Bank;
use App\Models\INS\Main;
use App\Models\INS\Taj;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BankAll extends Component
{
  use WithPagination;
  public $By=1;
    public function render()
    {

        return view('livewire.report.bank-all',[
          'BankSum'=>Bank::with('main')
            ->has('main')
            ->withCount('main as count')
            ->withSum('main as pay','pay')
            ->withSum('main as sul','sul')
            ->addSelect([
              'raseed'=>Main::wherecolumn('bank_id','banks.id')
                ->selectRaw('sum(sul-pay) as raseed')])
            ->paginate(15,pageName: 'BankSum'),
          'TajSum'=>Taj::with('mains')
            ->has('mains')
            ->withCount('mains as count')
            ->withSum('mains as pay','pay')
            ->withSum('mains as sul','sul')
            ->paginate(15,pageName: 'TajSum'),
        ]);
    }
}
