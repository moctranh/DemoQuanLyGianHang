<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category','description'
    ];

    protected $primaryKey = 'id';
    protected $table = 'category';

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
