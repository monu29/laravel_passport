<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'color',
        'store_id',
    ];
     public function store()
    {
        return $this->hasOne('App\Models\Store', 'id');
    }
}
