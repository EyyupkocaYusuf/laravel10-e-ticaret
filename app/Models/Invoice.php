<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = ['order_no', 'name', 'surname', 'email', 'phone', 'address', 'country', 'city', 'district', 'zip_code', 'order_note'];

     public function orders() {
         return $this->hasOne(Order::class,'order_no','order_no');
     }
}
