<?php

namespace App\models;

use App\helpers\Connection;
use App\models\Basket;

class Order
{
    public static function create($user_id, $street, $home, $apartment, $payment, $date_delivery, $time_delivery)
    {
        //получаем корзину пользователя
        $basket = Basket::productsInBasket($user_id);

        //установим подключение для работы с транзакцией
        $conn = Connection::make();

        //транзакция
        try {
            //открываем транзакцию
            $conn->beginTransaction();

            //1: создаём новый заказ
            $order_id = self::addOrder($user_id, $street, $home, $apartment, $payment, $date_delivery, $time_delivery, $conn);

            //2: добавляем продукты в заказ
            self::addSbInOrder($basket, $order_id, $conn);

            //3: очищаем корзину пользователя
            Basket::clear($user_id, $conn);

            //принимаем транзакцию
            $conn->commit();
        } catch (\PDOException $error) {
            //откатываем транзакцию в случаи ошибки
            $conn->rollBack();
            echo "Ошибка" . $error->getMessage();
        }
    }

    //добавление нового заказа
    public static function addOrder($user_id, $street, $home, $apartment, $payment, $date_delivery, $time_delivery, $conn)
    {
        $query = $conn->prepare('INSERT INTO orders (date_order,user_id,street,home,apartment,payment_method,date_delivery,time_delivery) VALUES (:date_order, :user_id, :street, :home, :apartment, :payment_method, :date_delivery, :time_delivery)');
        $query->execute([
            ':date_order' => date("Y-m-d"),
            ':user_id' => $user_id,
            ':street' => $street,
            ':home' => $home,
            ':apartment' => $apartment,
            ':payment_method' => $payment,
            ':date_delivery' => $date_delivery,
            ':time_delivery' => $time_delivery
        ]);
        return $conn->lastInsertId();
    }

    private static function getParams($array, $value)
    {
        return implode(",", array_fill(0, count($array), $value));
    }

    //добавление продуктов в таблицу order_products
    public static function addSbInOrder($basket, $order_id, $conn)
    {
        $queryText = "INSERT INTO sb_in_order (order_id,system_block_id ,count) VALUES ";
        $params = self::getParams($basket, "(?,?,?)");
        $queryText .= $params;
        $values = [];
        foreach ($basket as $item) {
            array_push($values, $order_id, $item->product_id, $item->count);
        }
        $query = $conn->prepare($queryText);
        $query->execute($values);
    }

    public static function searchReview($user_id, $system_block_id)
    {
        $query = Connection::make()->prepare("SELECT sb_in_order.* FROM sb_in_order INNER JOIN orders ON orders.id = sb_in_order.order_id WHERE orders.user_id = :user_id AND sb_in_order.system_block_id = :system_block_id AND sb_in_order.rating IS NOT NULL AND sb_in_order.review IS NOT NULL");
        $query->execute([
            ':user_id' => $user_id,
            ':system_block_id' => $system_block_id
        ]);
        return $query->fetch();
    }

    //проверка, есть ли такой заказ под таким user в таблице order
    public static function searchProductInOrder($user_id, $system_block_id)
    {
        $reviewProduct = self::searchReview($user_id, $system_block_id);

        if ($reviewProduct == false) {
            $query = Connection::make()->prepare("SELECT orders.id, sb_in_order.rating FROM orders INNER JOIN sb_in_order ON sb_in_order.order_id = orders.id WHERE orders.user_id = :user_id AND sb_in_order.system_block_id = :system_block_id AND orders.status_id = 4");
            $query->execute([
                ':user_id' => $user_id,
                ':system_block_id' => $system_block_id
            ]);
            $order_id = $query->fetch();

            if ($order_id) {
                return $order_id;
            }
            return "status";
        }
        return "review";
    }

    //оставить отзыв
    public static function review($system_block_id, $user_id, $rating, $review)
    {
        $order_id = self::searchProductInOrder($user_id, $system_block_id);

        if ($order_id == "status") {
            return "status";
        }
        if ($order_id == "review") {
            return "review";
        }

        if ($order_id->rating == null) {
            $query = Connection::make()->prepare("UPDATE sb_in_order SET sb_in_order.rating = :rating, sb_in_order.review = :review WHERE sb_in_order.system_block_id = :system_block_id AND sb_in_order.order_id = :order_id");
            $query->execute([
                'system_block_id' => $system_block_id,
                ':order_id' => $order_id->id,
                ':rating' => $rating,
                ':review' => $review
            ]);
            return null;
        }
    }

    //все отзывы по определённому продукту
    public static function allReviewOrderByProduct($system_block_id)
    {
        $query = Connection::make()->prepare("SELECT sb_in_order.*, users.name as name, users.surname as surname, orders.date_delivery as date_delivery FROM sb_in_order INNER JOIN orders ON orders.id = sb_in_order.order_id INNER JOIN users ON users.id = orders.user_id WHERE sb_in_order.system_block_id = :system_block_id AND sb_in_order.rating > 0");
        $query->execute([
            ':system_block_id' => $system_block_id
        ]);
        return $query->fetchAll();
    }

    public static function countRatingForProductInOrder($system_block_id)
    {
        $query = Connection::make()->prepare("SELECT COUNT(id) as count_raviews FROM sb_in_order WHERE system_block_id = :system_block_id AND sb_in_order.rating > 0");
        $query->execute([
            ':system_block_id' => $system_block_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function feedbackPercentage($system_block_id, $rating)
    {
        $query = Connection::make()->prepare("SELECT COUNT(id) as count_raviews FROM sb_in_order WHERE system_block_id = :system_block_id AND rating = :rating");
        $query->execute([
            ':system_block_id' => $system_block_id,
            ':rating' => $rating
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function sumRatingForProductInOrder($system_block_id)
    {
        $query = Connection::make()->prepare("SELECT SUM(rating) as sum_raviews FROM sb_in_order WHERE system_block_id = :system_block_id");
        $query->execute([
            ':system_block_id' => $system_block_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function all()
    {
        $query = Connection::make()->query("SELECT orders.*, users.name as user, statuses.name as status FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN statuses ON statuses.id = orders.status_id");
        return $query->fetchAll();
    }

    public static function totalPrice($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(system_blocks.price) as total_price FROM sb_in_order INNER JOIN system_blocks ON sb_in_order.system_block_id = system_blocks.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function totalCount($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(sb_in_order.count) as total_count FROM sb_in_order INNER JOIN system_blocks ON sb_in_order.system_block_id = system_blocks.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function allStatus()
    {
        $query = Connection::make()->query("SELECT * FROM statuses");
        return $query->fetchAll();
    }

    public static function updateStatus($id, $status_id)
    {
        $query = Connection::make()->prepare("UPDATE orders SET status_id = :status_id WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':status_id' => $status_id
        ]);
    }

    public static function statusCansel($id, $status_id, $reason_cancel)
    {
        $query = Connection::make()->prepare("UPDATE orders SET status_id = :status_id, reason_cancel = :reason_cancel WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':status_id' => $status_id,
            ':reason_cancel' => $reason_cancel
        ]);
    }

    public static function ordersByManyStatuses($status)
    {
        $query = Connection::make()->prepare("SELECT orders.*, users.name as user, statuses.name as status FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN statuses ON orders.status_id = statuses.id WHERE orders.status_id = :status");
        $query->execute([
            ':status' => $status
        ]);
        return $query->fetchAll();
    }

    public static function findStatusInOrder($id)
    {
        $query = Connection::make()->prepare("SELECT orders.*, statuses.name as status FROM orders INNER JOIN statuses ON orders.status_id = statuses.id WHERE orders.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}
