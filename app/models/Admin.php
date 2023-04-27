<?php

namespace App\models;

use App\helpers\Connection;
use App\models\User;

class Admin
{
    public static function addAdmin($data)
    {
        $user = User::getUser($data['email'], $data['password']);
        if ($user == null) {
            $query = Connection::make()->prepare("INSERT INTO users (surname,name,password,phone,email,role_id) VALUES (:surname,:name,:password,:phone,:email,2)");
            return $query->execute([
                ':surname' => $data['surname'],
                ':name' => $data['name'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':phone' => $data['phone'],
                ':email' => $data['email'],
            ]);
        } else {
            return null;
        }
    }

    public static function allAdmin()
    {
        $query = Connection::make()->query("SELECT * FROM users WHERE users.role_id = 2");
        return $query->fetchAll();
    }

    public static function deleteAdmin($id)
    {
        $query = Connection::make()->prepare("DELETE FROM users WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }

    public static function getProductsInOrder($id)
    {
        $query = Connection::make()->prepare("SELECT sb_in_order.*,system_blocks.name as name,system_blocks.price FROM sb_in_order INNER JOIN orders ON sb_in_order.order_id = orders.id INNER JOIN system_blocks ON sb_in_order.system_block_id = system_blocks.id WHERE sb_in_order.order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchAll();
    }

    //итоговая сумма товаров в заказе
    public static function totalPriceInOrderProducts($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(system_blocks.price) as total_price FROM sb_in_order INNER JOIN system_blocks ON sb_in_order.system_block_id = system_blocks.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //общее количество товаров в заказе
    public static function totalCountInOrderProducts($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(count) as total_count FROM sb_in_order WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function infoOrderInProducts($id)
    {
        $query = Connection::make()->prepare("SELECT orders.id, users.name as user, users.email as email, orders.street as street, orders.home as home, orders.apartment as apartment, orders.date_delivery as date_delivery, orders.time_delivery as time_delivery FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    public static function allAccessories()
    {
        $query = Connection::make()->query("SELECT * FROM accessories");
        return $query->fetchAll();
    }
}
