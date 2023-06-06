<?php
namespace App\Traits ;

trait SortData
{
    public function sortASC($attribute)
    {
        return $this->model->orderBy($attribute,'ASC')->get();
    }

    public function sortDESC($attribute)
    {
        return $this->model->orderBy($attribute,'DESC')->get();
    }
}