<?php

namespace App\Models\INS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trans extends Model
{
    use HasFactory;
    protected $connection = 'other';
    protected $guarded = [];
    protected $table = 'trans';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Auth::check()) {
            $this->connection=Auth::user()->company;
        }
    }
    public function main(){
      return  $this->belongsTo(Main::class);
    }
    public function ksm_type(){
        return $this->belongsTo(Ksm_type::class);
    }

}
