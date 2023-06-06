<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $primaryKey = 'id';
    protected $table = 'order';

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\OrderFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id','id');
    }

    /**
     * The products that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'list_item', 'order_id', 'product_id')->withPivot('quantity');
    }

}
