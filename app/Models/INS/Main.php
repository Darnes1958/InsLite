<?php

namespace App\Models\INS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Main extends Model
{
    use HasFactory;
    protected $connection = 'other';
    protected $guarded = [];
    protected $table = 'mains';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Auth::check()) {
            $this->connection=Auth::user()->company;
        }
    }
    public function cust(){
        return $this->belongsTo(Cust::class);
    }
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

  protected $appends = ['raseed'];

  public function getRaseedAttribute()
  {
    return $this->sul - $this->pay;
  }

}
