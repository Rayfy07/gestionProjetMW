<?php

namespace App\validators;

use App\class\Customer;

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

        if(!empty(verify($customer->getName())))
        {
            $customer->setName(verify($customer->getName()));
            $customer->setCode(str_replace(" ", "_", strtoupper("CUST_".verify($customer->getCode()))));
            $customer->setNotes(verify($customer->getNotes()));
            return true;
        }
        else
        {
            return false;
        }
    }
}