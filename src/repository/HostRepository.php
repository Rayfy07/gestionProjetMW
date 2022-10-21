<?php

namespace App\repository;

use App\
{
    class\Host,
    connection\DataBaseConnection
};

class HostRepository
{
    public static function insert(Host $host): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $insert = $database->prepare(
                "INSERT INTO host(code, name, notes) VALUES (?,?,?)"
            );
            $insert->execute(array(
                $host->getCode(),
                $host->getName(),
                $host->getNotes()
            ));

            $select = $database->prepare(
                "SELECT LAST_INSERT_ID() as id FROM host"
            );
            $select->execute();
            $newId = $select->fetch();

            $host->setId($newId['id']);

            $database = DataBaseConnection::disconnect();
            return true;
        } catch (Exeption) {
            return false;
        }
    }

    public static function update(Host $host): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $update = $database->prepare(
                "UPDATE host SET
                    code = ?,
                    name = ?,
                    notes = ?
                WHERE id=?"
            );
            $update->execute(array(
                $host->getCode(),
                $host->getName(),
                $host->getNotes(),
                $host->getId()
            ));

            $database = DataBaseConnection::disconnect();
            return true;
        } catch(Exeption) {
            return false;
        }
    }

    public static function delete(Host $host): bool
    {
        try {
            $database = DataBaseConnection::connect();
            $update = $database->prepare(
                "DELETE FROM host WHERE id=?"
            );
            $update->execute(array($host->getId()));

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
                "SELECT * FROM host"
            );
            $select->execute();
            $hosts = array();
            while ($rowSelect = $select->fetch()) {
                $host = new Host(
                    $rowSelect['id'],
                    $rowSelect['code'],
                    $rowSelect['name'],
                    $rowSelect['notes']
                );
                array_push(
                    $hosts,
                    $host
                );
            }
            $database = DataBaseConnection::disconnect();
            return $hosts;
        } catch (Exeption) {
            return null;
        }
    }

    public static function selectById(int $int): ?Host
    {
        try {
            $database = DataBaseConnection::connect();
            $select = $database->prepare(
                "SELECT * FROM host WHERE id = ?"
            );
            $select->execute(array($int));
            if ($rowSelect = $select->fetch()) {
                $host = new Host(
                    $rowSelect['id'],
                    $rowSelect['code'],
                    $rowSelect['name'], 
                    $rowSelect['notes']
                );

                $database = DataBaseConnection::disconnect();
                return $host;
            } else {
                return null;
            }
        } catch (Exeption) {
            return null;
        }
    }

    public static function count(): int
    {
        $database = DataBaseConnection::connect();
        $select = $database->prepare(
            "SELECT COUNT(*) as total FROM host"
        );
        $select->execute();
        $rowSelect = $select->fetch();
        $count = $rowSelect['total'];
        $database = DataBaseConnection::disconnect();
        return $count;
    }
}