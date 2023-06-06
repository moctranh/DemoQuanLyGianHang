<?php
namespace Modules\Manager\Repositories;

use Modules\Manager\Entities\Category;
use App\Traits\SortData;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    use SortData;

    public function getModel()
    {
        return Category::class;
    }

    public function getAll()
    {
        $query = $this->model->query()
            ->orderBy('category', 'asc');
        return $query->get();
    }


}