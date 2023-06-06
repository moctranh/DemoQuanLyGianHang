<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];

    protected $primaryKey = 'id';
    protected $table = 'list_item';
}
