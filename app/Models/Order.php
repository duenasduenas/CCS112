<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['item_id','name','price','details'];

    public function user(){
        return $this->belongsTo(Product::class,'item_id');
    }
}
