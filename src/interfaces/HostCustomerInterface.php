<?php

namespace App\interfaces;

use App\
{
    class\Host,
    class\Customer
};

interface HostCustomerInterface
{
    public function getHost(): Host;
    public function setHost(Host $newHost): void;
    public function getCustomer(): Customer;
    public function setCustomer(Customer $newCustomer): void;
}

?>