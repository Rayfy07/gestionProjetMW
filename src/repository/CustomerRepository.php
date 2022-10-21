<?php

namespace App\repository;

use App\
{
    class\Customer,
    connection\DataBaseConnection
};

class CustomerRepository
{
    public static function insert(Customer $customer): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $insert = $database->prepare(
                "INSERT INTO customer(code, name, notes) VALUES (?,?,?)"
            );
            $insert->execute(array(
                $customer->getCode(),
                $customer->getName(),
                $customer->getNotes()
            ));

            $select = $database->prepare(
                "SELECT LAST_INSERT_ID() as id FROM customer"
            );
            $select->execute();
            $newId = $select->fetch();

            $customer->setId($newId['id']);

            $database = DataBaseConnection::disconnect();
            return true;
        } catch (Exeption) {
            return false;
        }
    }

    public static function update(Customer $customer): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $update = $database->prepare(
                "UPDATE customer SET 
                    code = ?,
                    name = ?,
                    notes = ?
                WHERE id=?"
            );

            $update->execute(array(
                $customer->getCode(),
                $customer->getName(),
                $customer->getNotes(),
                $customer->getId()
            ));

            $database = DataBaseConnection::disconnect();
            return true;
        } catch(Exeption) {
            return false;
        }
    }

    public static function delete(Customer $customer): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $delete = $database->prepare(
                "DELETE FROM customer WHERE id=?"
            );
            $delete->execute(array($customer->getId()));

            $database = DataBaseConnection::disconnect();
            return true;
        } catch (Exeption) {
            return false;
        }
    }

    public static function selectAll(): ?array
    {
        try {
            $database = DataBaseConnection::connect();
            $select = $database->prepare(
                "SELECT * FROM customer"
            );
            $select->execute();
            $customers = array();

            while ($rowSelect = $select->fetch()) {
                $customer = new Customer(
                    $rowSelect['id'],
                    $rowSelect['code'],
                    $rowSelect['name'],
                    $rowSelect['notes']
                );
                array_push(
                    $customers,
                    $customer
                );
            }

            $database = DataBaseConnection::disconnect();
            return $customers;
        } catch (Exeption) {
            return null;
        }
    }

    public static function selectById(int $int): ?Customer
    {
        try {
            $database = DataBaseConnection::connect();
            $select = $database->prepare(
                "SELECT * FROM customer WHERE id = ?"
            );
            $select->execute(array($int));

            if ($rowSelect = $select->fetch()) {
                $customer = new Customer(
                    $rowSelect['id'],
                    $rowSelect['code'],
                    $rowSelect['name'],
                    $rowSelect['notes']
                );

                $database = DataBaseConnection::disconnect();
                return $customer;
            } else {
                return null;
            }
        } catch (Exeption) {
            return null;
        }
    }

    public static function nameExist($name): ?bool
    {
        try {
            $database = DataBaseConnection::connect();
            $select = $database->prepare(
                "SELECT * FROM customer WHERE name = ?"
            );
            $select->execute(array($name));

            if($rowSelect = $select->fetch()) {
                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                $database = DataBaseConnection::disconnect();
                return false;
            }
        } catch (Exeption) {
            return null;
        }
    }

    public static function hasProject($id): ?bool
    {
        try {
            $database = DataBaseConnection::connect();
            $select = $database->prepare(
                "SELECT * FROM project WHERE customer_id = ?"
            );
            $select->execute(array($name));

            if($rowSelect = $select->fetch()) {
                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                $database = DataBaseConnection::disconnect();
                return false;
            }
        } catch (Exeption) {
            return null;
        }
    }

    public static function count(): int
    {
        $database = DataBaseConnection::connect();
        $select = $database->prepare(
            "SELECT COUNT(*) as total FROM customer"
        );
        $select->execute();
        $rowSelect = $select->fetch();
        $count = $rowSelect['total'];
        $database = DataBaseConnection::disconnect();
        return $count;
    }
}