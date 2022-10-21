<?php

namespace App\traits;

use App\class\Host;
use App\class\Customer;

trait HostCustomerTrait
{
    private Host $host;
    private Customer $customer;

    public function getHost(): Host
    {
        return $this->host;
    }
    public function setHost(Host $newHost): void
    {
        $this->host = $newHost;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }
    public function setCustomer(Customer $newCustomer): void
    {
        $this->customer = $newCustomer;
    }
}

?>