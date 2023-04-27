<?php

namespace App\models;

use App\helpers\Connection;

//содержаться все методы необходимые для работы с пользователем в базе
class User
{

    public static function insert($data)
    {
        $user = self::getUser($data['email'], $data['password']);
        if ($user == null) {
            $query = Connection::make()->prepare("INSERT INTO users (surname,name,password,phone,email) VALUES (:surname,:name,:password,:phone,:email)");

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

    public static function getUser($email, $password)
    {
        $query = Connection::make()->prepare("SELECT users.*, roles.name as status FROM users INNER JOIN roles ON roles.id = users.role_id WHERE users.email = :email");
        $query->execute([':email' => $email]);
        $user = $query->fetch();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return null;
    }

    public static function updateInfo($id, $email, $phone)
    {
        $query = Connection::make()->prepare("UPDATE users SET email = :email, phone = :phone WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':email' => $email,
            ':phone' => $phone
        ]);
    }

    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM users WHERE users.id = :id");
        $query->execute(['id' => $id]);
        $user = $query->fetch();
        return $user;
    }

    public static function findOrder($id)
    {
        $query = Connection::make()->prepare("SELECT orders.*, statuses.name as status FROM orders INNER JOIN statuses ON statuses.id = orders.status_id WHERE orders.user_id = :id");
        $query->execute(['id' => $id]);
        $orders = $query->fetchAll();
        return $orders;
    }

    public static function findProductsInOrder($id, $order_id)
    {
        $query = Connection::make()->prepare("SELECT sb_in_order.*, system_blocks.name as name, system_blocks.price as price, system_blocks.image as image,system_blocks.id as sb_id FROM sb_in_order INNER JOIN orders ON orders.id = sb_in_order.order_id INNER JOIN system_blocks ON system_blocks.id = sb_in_order.system_block_id WHERE orders.user_id = :id AND sb_in_order.order_id = :order_id");
        $query->execute([
            ':id' => $id,
            ':order_id' => $order_id
        ]);
        $productsInOrder = $query->fetchAll();
        return $productsInOrder;
    }
}
