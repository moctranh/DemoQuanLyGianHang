<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','customer_ordering','waiting_confirm','confirm','paid'
    ];
    protected $primaryKey = 'id';
    protected $table = 'order';



    /**
     * The roles that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'list_item')->withPivot('quantity');
    }
}
