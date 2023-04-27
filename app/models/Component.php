<?php

namespace App\models;

use App\helpers\Connection;

class Component
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT components.*, characteristics.name as characteristic, accessories.name as accessory FROM components INNER JOIN characteristics ON characteristics.id = components.characteristic_id INNER JOIN accessories ON accessories.id = components.accessory_id");
        return $query->fetchAll();
    }

    public static function CPU()
    {
        $query = Connection::make()->query("SELECT * FROM components WHERE accessory_id = 1");
        return $query->fetchAll();
    }

    public static function videoCard()
    {
        $query = Connection::make()->query("SELECT * FROM components WHERE accessory_id = 2");
        return $query->fetchAll();
    }

    public static function newComponents()
    {
        $query = Connection::make()->query("SELECT * FROM components ORDER BY date_added DESC LIMIT 5");
        return $query->fetchAll();
    }

    public static function componentsByAccessory($accessory_id)
    {
        $query = Connection::make()->prepare("SELECT components.*, characteristics.name as characteristic, accessories.name as accessory FROM components INNER JOIN characteristics ON characteristics.id = components.characteristic_id INNER JOIN accessories ON accessories.id = components.accessory_id WHERE components.accessory_id = :accessory_id");
        $query->execute([
            ':accessory_id' => $accessory_id
        ]);
        return $query->fetchAll();
    }

    public static function componentById($id){
        $query = Connection::make()->prepare("SELECT * FROM components WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    public static function addComponent($meaning, $characteristic_id, $accessory_id, $image, $description)
    {
        if (empty($image) && empty($description)) {
            $query = Connection::make()->prepare("INSERT INTO components (meaning, date_added, characteristic_id, accessory_id) VALUE(:meaning, :date_added, :characteristic_id, :accessory_id)");
            $query->execute([
                ':meaning' => $meaning,
                ':date_added' => date("Y-m-d H:i:s"),
                ':characteristic_id' => $characteristic_id,
                ':accessory_id' => $accessory_id
            ]);
        } else {
            $query = Connection::make()->prepare("INSERT INTO components (meaning, image, description, date_added, characteristic_id, accessory_id) VALUE(:meaning, :image, :description, :date_added, :characteristic_id, :accessory_id)");
            $query->execute([
                ':meaning' => $meaning,
                ':image' => $image,
                ':description' => $description,
                ':date_added' => date("Y-m-d H:i:s"),
                ':characteristic_id' => $characteristic_id,
                ':accessory_id' => $accessory_id
            ]);
        }
    }

    public static function deleteComponent($id)
    {
        $query = Connection::make()->prepare("DELETE FROM components WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }

    public static function getComponent($meaning, $characteristic_id, $accessory_id)
    {
        $query = Connection::make()->prepare("SELECT * FROM components WHERE meaning = :meaning AND characteristic_id = :characteristic_id AND accessory_id = :accessory_id");
        $query->execute([
            ':meaning' => $meaning,
            ':characteristic_id' => $characteristic_id,
            ':accessory_id' => $accessory_id
        ]);
        return $query->fetch();
    }

    public static function componentByAccessory($accessory_id)
    {
        $query = Connection::make()->prepare("SELECT components.*, accessories.name FROM components INNER JOIN accessories ON accessories.id = components.accessory_id WHERE components.accessory_id = :accessory_id");
        $query->execute([
            ':accessory_id' => $accessory_id
        ]);
        return $query->fetchAll();
    }

    public static function componentInSb($name)
    {
        $query = Connection::make()->prepare("SELECT components.*, accessories.name FROM components INNER JOIN accessories ON accessories.id = components.accessory_id WHERE accessories.name = :name");
        $query->execute([
            ':name' => $name
        ]);
        return $query->fetchAll();
    }

    public static function addComponentsInSb($system_block_id, $components)
    {
        foreach ($components as $component) {
            $query = Connection::make()->prepare("INSERT INTO components_in_sb (system_block_id, component_id) VALUE(:system_block_id, :component_id)");
            $query->execute([
                ':system_block_id' => $system_block_id,
                ':component_id' => $component,
            ]);
        }
    }

    public static function getInfoByComponent($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM components WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}
