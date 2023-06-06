<?php
namespace Modules\Customer\Repositories;

use App\Repositories\BaseGetOnlyRepository;
use Modules\Customer\Entities\Category;

class CategoryRepository extends BaseGetOnlyRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}