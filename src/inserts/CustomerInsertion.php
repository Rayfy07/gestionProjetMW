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
            $insert = $database->prepare("INSERT INTO customer(code, name, notes) VALUES (?,?,?)");
            $insert->execute(array($customer->getCode(), $customer->getName(), $customer->getNotes()));

            $select = $database->prepare("SELECT LAST_INSERT_ID() as id FROM customer");
            $select->execute();
            $newId = $select->fetch();

            $customer->setId($newId['id']);

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