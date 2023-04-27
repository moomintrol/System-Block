<?php

namespace App\models;

use App\helpers\Connection;

class Basket
{
    //ищем товар в корзине пользователя
    public static function search($product_id, $user_id)
    {
        $query = Connection::make()->prepare("SELECT baskets.*, system_blocks.price, baskets.count*system_blocks.price as price_position FROM baskets INNER JOIN system_blocks ON baskets.product_id = system_blocks.id WHERE product_id = :product_id AND user_id = :user_id");
        $query->execute([
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);
        return $query->fetch();
    }

    //итоговая стоимость
    public static function totalPrice($user_id)
    {
        $query = Connection::make()->prepare("SELECT SUM(baskets.count*system_blocks.price) as sum FROM baskets INNER JOIN system_blocks ON baskets.product_id = system_blocks.id WHERE baskets.user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //итоговое количество
    public static function totalCount($user_id)
    {
        $query = Connection::make()->prepare("SELECT SUM(count) as total_count FROM baskets WHERE user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //добавление товар в корзину пользователя
    public static function add($product_id, $user_id)
    {
        //поищем товар в корзине пользователя
        $productInBasket = self::search($product_id, $user_id);

        //если товара нет в корзине, то мы его в корзину добавим в количестве = 1
        if (!$productInBasket) {
            $query = Connection::make()->prepare('INSERT INTO baskets (count,user_id,product_id) VALUE (1,:user_id,:product_id)');
            $query->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id
            ]);
        } else {
            $query = Connection::make()->prepare('UPDATE baskets SET count=count+1 WHERE product_id = :product_id AND user_id = :user_id');
            $query->execute([
                'product_id' => $product_id,
                'user_id' => $user_id
            ]);
        }

        return self::search($product_id, $user_id);
    }

    //уменьшение количество товара в корзине пользователя на 1
    public static function minus($product_id, $user_id)
    {
        //поищем товар в корзине пользователя
        $productInBasket = self::search($product_id, $user_id);

        if ($productInBasket->count > 1) {
            $query = Connection::make()->prepare('UPDATE baskets SET count=count-1 WHERE product_id = :product_id AND user_id = :user_id');
            $query->execute([
                'product_id' => $product_id,
                'user_id' => $user_id
            ]);
        }
        return self::search($product_id, $user_id);
    }

    //получаем корзину пользователя
    public static function productsInBasket($user_id)
    {
        $query = Connection::make()->prepare('SELECT baskets.*, system_blocks.image, system_blocks.name, system_blocks.price, baskets.count*system_blocks.price as price_position FROM baskets INNER JOIN system_blocks ON baskets.product_id = system_blocks.id WHERE baskets.user_id = :user_id');
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll();
    }

    //удаляем товар из корзины
    public static function delete($product_id, $user_id)
    {
        $query = Connection::make()->prepare("DELETE FROM baskets WHERE product_id = :product_id AND user_id = :user_id");
        $query->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id
        ]);
        return false;
    }

    //очищаем корзину пользователя
    public static function clear($user_id, $conn = null)
    {
        $conn = $conn ?? Connection::make();

        $query = $conn->prepare("DELETE FROM baskets WHERE user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);

        return false;
    }
}
