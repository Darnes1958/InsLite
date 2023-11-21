<?php

namespace App\Models\INS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bank extends Model
{
    use HasFactory;
    protected $connection = 'other';
    protected $guarded = [];
    protected $table = 'banks';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Auth::check()) {
            $this->connection=Auth::user()->company;
        }
    }
    public function taj(){
        return $this->belongsTo(Taj::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function main(){
      return $this->hasMany(Main::class);
    }
}
