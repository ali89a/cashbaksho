<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'item_name', 'amount', 'date', 'description'];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
