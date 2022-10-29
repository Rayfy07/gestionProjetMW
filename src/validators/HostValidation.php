<?php

namespace App\validators;

use App\class\Host;
use slugifier as s;

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
            $host->setCode(strtoupper("HOST_".s\slugify(verify($host->getCode()), '_')));
            $host->setNotes(verify($host->getNotes()));
            return true;
        } else {
            return false;
        }
    }
}