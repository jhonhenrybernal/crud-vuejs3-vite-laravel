<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order',
        'user_id',
        'cost',
        'date_purchase'
    ];

    public function purchaseOrderProduct() {
        return $this->hasMany('App\Models\PurchaseOrderProduct','purchase_orders_id');
    }

    public function user() {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function client() {
        return $this->hasOne('App\Models\Client','id','user_id');
    }
}
