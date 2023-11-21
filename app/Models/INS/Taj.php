<?php

namespace App\Models\INS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Taj extends Model
{
    use HasFactory;
    protected $connection = 'other';
    protected $guarded = [];
    protected $table = 'tajs';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Auth::check()) {
            $this->connection=Auth::user()->company;
        }
    }

    public function bank()
    {
        return $this->hasMany(Bank::class);
    }
  public function mains()
  {
    return $this->hasManyThrough('App\Models\INS\main', 'App\Models\INS\bank');
  }


}
