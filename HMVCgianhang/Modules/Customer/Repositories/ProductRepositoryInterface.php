<?php
namespace Modules\Customer\Repositories;

use App\Repositories\GetOnlyRepositoryInterface;

interface ProductRepositoryInterface extends GetOnlyRepositoryInterface
{
    public function wasBought($id,$quantity);
}