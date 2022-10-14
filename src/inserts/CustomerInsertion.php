<?php

    namespace App\inserts;

    use App\class\Customer;
    use App\connection\DataBaseConnection;

    class CustomerValidation
    {
        public static function insret(Customer $customer): bool
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
                catch
                {
                    return true;
                }
            }
            catch
            {
                return false;
            }
        }
    }
?>