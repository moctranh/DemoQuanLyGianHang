<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\SortByCreateScope;

class HistoryOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','product_id','quantity','product','image','description','price',
    ];

    protected $primaryKey = 'id';
    protected $table = 'history_order';
    

    protected static function booted()
    {
        static::addGlobalScope(new SortByCreateScope);
    }

    protected static function newFactory()
    {
        return \Modules\Customer\Database\factories\HistoryOrderFactory::new();
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
