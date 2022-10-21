<?php

namespace App\validators;

use App\class\Host;

class HostValidation
{
    public static function isValid(Host $host): bool
    {
        function verify(string $input): string
        {
            $input = htmlspecialchars($input);
            $input = stripcslashes($input);
            $input = trim($input);
            return $input;
        }

        if (!empty(verify($host->getName()))) {
            $host->setName(verify($host->getName()));
            $host->setCode(str_replace(
                " ",
                "_",
                strtoupper("CUST_".verify($host->getCode()))
            ));
            $host->setNotes(verify($host->getNotes()));
            return true;
        } else {
            return false;
        }
    }
}