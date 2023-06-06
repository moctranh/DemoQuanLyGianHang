<?php

namespace Modules\Manager\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Manager\Repositories\HistoryOrderRepository;

class ConfirmOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->history_order_repo = new HistoryOrderRepository();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $list_product = $this->history_order_repo->getByOrder($event->order_id);
        foreach ($list_product as $key => $product_order)
        {
            $product = $product_order->product()->first();
            $product->sold += $product_order->quantity;
            $product->save();


            $category = $product->category;
            $category->turnover += $product_order->total;
            
            $category->save();
        }
    }
}
