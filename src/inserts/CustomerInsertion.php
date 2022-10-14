<?php

namespace App\inserts;

use App\class\Customer;
use App\connection\DataBaseConnection;

class CustomerInsertion
{
    public static function insert(Customer $customer): bool
    {
        try
        {
            $database = DataBaseConnection::connect();
            $insert = $database->prepare("INSERT INTO customer VALUES (?,?,?,?)");
            $insert->execute(array($customer->getId(), $customer->getCode(), $customer->getName(), $customer->getNotes()));
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