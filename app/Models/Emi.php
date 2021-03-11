<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emi extends Model
{
    use HasFactory;
    protected $fillable = ['shop_id','product_id','customer_name','total_amount','total_installment'];
}
