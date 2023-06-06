<?php
namespace Modules\Customer\Repositories;
use App\Repositories\RepositoryInterface;
interface ListItemRepositoryInterface extends RepositoryInterface
{
    // Tăng số lượng của sản phẩm trong giỏ hàng
    public function quantityIncrement($id);

    // Giảm số lượng của sản phẩm trong giỏ hàng
    public function quantityDecrement($id);

}