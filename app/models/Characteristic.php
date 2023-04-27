<?php

namespace App\models;

use App\helpers\Connection;

class Characteristic
{
    public static function allCharacteristics()
    {
        $query = Connection::make()->query("SELECT * FROM characteristics");
        return $query->fetchAll();
    }

    public static function addCharacteristics($name)
    {
        $query = Connection::make()->prepare("INSERT INTO characteristics (name) VALUE(:name)");
        $query->execute([
            ':name' => $name
        ]);
    }

    public static function deleteCharacteristic($id)
    {
        $query = Connection::make()->prepare("DELETE FROM characteristics WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }

    public static function getCharacteristics($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM characteristics WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        return $query->fetch();
    }
}