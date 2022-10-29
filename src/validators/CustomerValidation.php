<?php

namespace App\validators;

use App\class\Customer;
use slugifier as s;

class CustomerValidation
{
    public static function isValid(Customer $customer): bool
    {
        function verify(string $input): string
        {
            $input = htmlspecialchars($input);
            $input = stripcslashes($input);
            $input = trim($input);
            return $input;
        }

        if (!empty(verify($customer->getName()))) {
            $customer->setName(verify($customer->getName()));
            $customer->setCode(strtoupper("CUST_".s\slugify(verify($customer->getCode()), '_')));
            $customer->setNotes(verify($customer->getNotes()));
            return true;
        } else {
            return false;
        }
    }
}