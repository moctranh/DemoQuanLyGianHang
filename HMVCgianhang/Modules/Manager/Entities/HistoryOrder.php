<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\HistoryOrderScope;
use App\Scopes\SortByCreateScope;

class HistoryOrder extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $primaryKey = 'id';
    protected $table = 'history_order';
    
    protected static function booted()
    {
        static::addGlobalScope(new SortByCreateScope);
    }

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\HistoryOrderFactory::new();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
