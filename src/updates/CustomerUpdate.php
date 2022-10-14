<?php

namespace App\updates;

use App\class\Customer;
use App\connection\DataBaseConnection;

class CustomerUpdate
{
    public static function update(Customer $customer): bool
    {
        try
        {
            $database = DataBaseConnection::connect();
            $update = $database->prepare("UPDATE customer SET code = ?, name = ?, notes = ? WHERE id=?");
            $update->execute(array($customer->getCode(), $customer->getName(), $customer->getNotes(), $customer->getId()));
            try
            {
                $database = DataBaseConnection::disconnect();
                return true;
            }
            catch(Exeption)
            {
                return true;
            }
        }
        catch(Exeption)
        {
            return false;
        }
    }
}
?>