<?php

namespace App\Livewire\Frontend;

use App\Data\SalesOrder\SalesOrderData;
use App\Models\SalesOrder;
use App\Services\Payment\PaymentMethodQueryService;
use Livewire\Component;

class OrderConfirmed extends Component
{
    public SalesOrder $sales_order;

    public function render()
    {

        $service = app(PaymentMethodQueryService::class);
        $sales_order_data = SalesOrderData::fromModel($this->sales_order);
        return view('livewire.frontend.order-confirmed', [
            'order' => $sales_order_data,
            'is_redirect' => $service->shouldShowButton($sales_order_data),
            'redirect_url' => $service->getRedirectUrl($sales_order_data)
        ]);
    }
}
