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
            if($database = DataBaseConnection::connect()) {
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
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function update(Host $host): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $update = $database->prepare(
                    "UPDATE host SET
                        code = ?,
                        name = ?,
                        notes = ?
                    WHERE id = ?"
                );
                $update->execute(array(
                    $host->getCode(),
                    $host->getName(),
                    $host->getNotes(),
                    $host->getId()
                ));

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch(\Exception) {
            return false;
        }
    }

    public static function delete(Host $host): bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                //à remplacer quand CRUD contact sera fait
                $deleteCont = $database->prepare(
                    "DELETE FROM contact WHERE host_id = ?"
                );
                $deleteCont->execute(array($host->getId()));

                $delete = $database->prepare(
                    "DELETE FROM host WHERE id=?"
                );
                $delete->execute(array($host->getId()));

                $database = DataBaseConnection::disconnect();
                return true;
            } else {
                return false;
            }
        } catch (\Exception) {
            return false;
        }
    }

    public static function selectAll(): ?array
    {
        try {
            if($database = DataBaseConnection::connect()) {
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
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function selectById(int $int): ?Host
    {
        try {
            if($database = DataBaseConnection::connect()) {
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
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function selectByName(string $name): ?Host
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM host WHERE name = ?"
                );
                $select->execute(array($name));
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
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function hostExist($host): ?bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM host WHERE id = ?"
                );
                $select->execute(array($host->getId()));
    
                if ($rowSelect = $select->fetch()) {
                    $database = DataBaseConnection::disconnect();
                    return true;
                } else {
                    $database = DataBaseConnection::disconnect();
                    return false;
                }
            } else {
                return null;
            };
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function nameExist($name): ?bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM host WHERE name = ?"
                );
                $select->execute(array($name));
    
                if ($rowSelect = $select->fetch()) {
                    $database = DataBaseConnection::disconnect();
                    return true;
                } else {
                    $database = DataBaseConnection::disconnect();
                    return false;
                }
            } else {
                return null;
            };
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function hasProject($id): ?bool
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT * FROM project WHERE host_id = ?"
                );
                $select->execute(array($id));

                if($rowSelect = $select->fetch()) {
                    $database = DataBaseConnection::disconnect();
                    return true;
                } else {
                    $database = DataBaseConnection::disconnect();
                    return false;
                }
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    public static function count(): ?int
    {
        try {
            if($database = DataBaseConnection::connect()) {
                $select = $database->prepare(
                    "SELECT COUNT(*) as total FROM host"
                );
                $select->execute();
                $rowSelect = $select->fetch();
                $count = $rowSelect['total'];
                $database = DataBaseConnection::disconnect();
                return $count;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }
}