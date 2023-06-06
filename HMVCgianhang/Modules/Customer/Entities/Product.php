<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\SortByCreateScope;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new SortByCreateScope);
    }

    protected $fillable=[
        'product','image','category_id','description','store','price'
    ];

    protected $primaryKey='id';
    protected $table = 'product';
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
