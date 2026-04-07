<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Data\Payment\PaymentData;
use Spatie\LaravelData\DataCollection;
use App\Data\SalesOrder\SalesOrderData;
use App\Contract\PaymentDriverInterface;
use App\Data\SalesPayment\SalesPaymentData;
use App\Drivers\Payment\OfflinePaymentMethodDriver;
use App\Drivers\Payment\OnlinePaymentMethodDriver;

class PaymentMethodQueryService {

    protected array $drivers= [];

    public function __construct()
    {
        $this->drivers = [
            new OfflinePaymentMethodDriver(),
            new OnlinePaymentMethodDriver()
        ];
    }

    public function getDriver(PaymentData|SalesPaymentData $payment_data) : PaymentDriverInterface {
        return collect($this->drivers)->first(fn(PaymentDriverInterface $driver) => $driver->driver === $payment_data->driver);
    }

    public function getPaymentMethods() : DataCollection {
        return collect($this->drivers)->flatMap(fn(PaymentDriverInterface $driver) => $driver->getMethods()->toCollection())->pipe(fn($items) => PaymentData::collect($items, DataCollection::class));
    }

    public function getPaymentMethodByHash(string $hash) : ?PaymentData {
        return $this->getPaymentMethods()->toCollection()->first(fn(PaymentData $data) => $data->hash === $hash);
    }

    public function shouldShowButton(SalesOrderData $sales_order) : bool{
        return $this->getDriver(
            $sales_order->payment
        )->shouldPayNowButton($sales_order);
    }

    public function getRedirectUrl(SalesOrderData $sales_order) : ?string {
        return $this->getDriver(
            $sales_order->payment
        )->getRedirectUrl($sales_order);
    }

}