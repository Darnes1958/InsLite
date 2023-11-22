<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\INS\Bank;
use App\Models\INS\Main;
use App\Models\INS\Taj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
  function PdfBankSum(Request $request){

    $RepDate=date('Y-m-d');
    $cus=Customers::where('Company',Auth::user()->company)->first();
    if ($request->By=='2') {
      $res=Bank::with('main')
        ->has('main')
        ->withCount('main as count')
        ->withSum('main as pay','pay')
        ->withSum('main as sul','sul')
        ->addSelect([
          'raseed'=>Main::wherecolumn('bank_id','banks.id')
            ->selectRaw('sum(sul-pay) as raseed')])->get();
    }
    if ($request->By=='1'){
      $res=Taj::with('mains')
        ->has('mains')
        ->withCount('mains as count')
        ->withSum('mains as pay','pay')
        ->withSum('mains as sul','sul')->get();

    }

    $reportHtml = view('PrnView.pdf-bank-sum',
      ['RepTable'=>$res,'cus'=>$cus,'RepDate'=>$RepDate])->render();
    $arabic = new Arabic();
    $p = $arabic->arIdentify($reportHtml);

    for ($i = count($p)-1; $i >= 0; $i-=2) {
      $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i-1], $p[$i] - $p[$i-1]));
      $reportHtml = substr_replace($reportHtml, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
    }

    $pdf = PDF::loadHTML($reportHtml);
    return $pdf->download('report.pdf');

  }
}
