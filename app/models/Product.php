<?php

namespace App\models;

use App\helpers\Connection;

class Product
{
    //получаем товары отсортированные по новизне, при условии что они есть на складе
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM system_blocks");
        return $query->fetchAll();
    }

    //ищем товар на складе по его id
    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT system_blocks.*, categories.name as category FROM system_blocks INNER JOIN categories ON categories.id = system_blocks.category_id WHERE system_blocks.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    public static function allComponentsInSB($id)
    {
        $query = Connection::make()->prepare("SELECT components_in_sb.*, components.meaning as meaning, accessories.image as image, accessories.name as name, characteristics.name as characteristic FROM components_in_sb INNER JOIN components ON components.id = components_in_sb.component_id INNER JOIN accessories ON accessories.id = components.accessory_id INNER JOIN characteristics ON characteristics.id = components.characteristic_id  WHERE components_in_sb.system_block_id = :id");

        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchAll();
    }

    //получаем товары по указанным категориям
    public static function productsByManyCategories($category)
    {
        //формируем параметры для запроса
        $query = Connection::make()->prepare("SELECT * FROM system_blocks WHERE category_id = :category_id");
        $query->execute([
            'category_id' => $category
        ]);
        return $query->fetchAll();
    }

    public static function fillterByCpu($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data[$key] = "%%";
            };
        }

        $query = Connection::make()->prepare("SELECT system_blocks.* FROM system_blocks INNER JOIN components_in_sb ON components_in_sb.system_block_id = system_blocks.id INNER JOIN components ON components.id = components_in_sb.component_id INNER JOIN accessories ON accessories.id = components.accessory_id WHERE system_blocks.category_id LIKE :category_id AND system_blocks.price > :from_cost AND system_blocks.price < :before_cost AND components.id LIKE :cpu_id");
        $query->execute([
            ':category_id' => $data["category-id"],
            ':from_cost' => $data["from-cost"],
            ':before_cost' => $data["before-cost"],
            ':cpu_id' => $data["cpu"],
        ]);
        return $query->fetchAll();
    }

    public static function fillterByVideo($data, $block = null)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data[$key] = "%%";
            };
        }
        if ($block != null) {
            $block = join(",", $block);
            $block = " and system_blocks.id in (" . $block . ")";
        } else {
            $block = "";
        }

        $query = Connection::make()->prepare("SELECT system_blocks.* FROM system_blocks INNER JOIN components_in_sb ON components_in_sb.system_block_id = system_blocks.id INNER JOIN components ON components.id = components_in_sb.component_id INNER JOIN accessories ON accessories.id = components.accessory_id WHERE system_blocks.category_id LIKE :category_id AND system_blocks.price > :from_cost AND system_blocks.price < :before_cost AND components.id LIKE :video_id" . $block);
        $query->execute([
            ':category_id' => $data["category-id"],
            ':from_cost' => $data["from-cost"],
            ':before_cost' => $data["before-cost"],
            ':video_id' => $data["video-card"],
        ]);
        return $query->fetchAll();
    }

    public static function fillterByCost($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data[$key] = "%%";
            };
        }

        $query = Connection::make()->prepare("SELECT DISTINCT system_blocks.* FROM system_blocks INNER JOIN components_in_sb ON components_in_sb.system_block_id = system_blocks.id INNER JOIN components ON components.id = components_in_sb.component_id INNER JOIN accessories ON accessories.id = components.accessory_id WHERE system_blocks.category_id LIKE :category_id AND system_blocks.price > :from_cost AND system_blocks.price < :before_cost");
        $query->execute([
            ':category_id' => $data["category-id"],
            ':from_cost' => $data["from-cost"],
            ':before_cost' => $data["before-cost"],
        ]);
        return $query->fetchAll();
    }

    public static function update($id, $name, $price, $image, $category_id)
    {
        $query = Connection::make()->prepare("UPDATE system_blocks SET name = :name, price = :price, image = :image, category_id = :category_id WHERE id=:id");
        $query->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':image' => $image,
            ':category_id' => $category_id,
        ]);
    }

    public static function updateComponentInSb($system_block_id, $component_id, $old_component)
    {
        $query = Connection::make()->prepare("UPDATE components_in_sb SET components_in_sb.component_id = :component_id WHERE components_in_sb.system_block_id = :system_block_id AND components_in_sb.component_id = :old_component");
        $query->execute([
            ':component_id' => $component_id,
            ':system_block_id' => $system_block_id,
            ':old_component' => $old_component
        ]);
    }

    public static function updateRating($id)
    {
        $sum_raviews = Order::sumRatingForProductInOrder($id);

        if ($sum_raviews == null) {
            $sum_raviews = 0;
        }

        $query = Connection::make()->prepare("UPDATE system_blocks SET overall_rating = $sum_raviews / (count_reviews + 1), count_reviews = count_reviews + 1 WHERE system_blocks.id = :id");

        $query->execute([
            ':id' => $id
        ]);

        return $query->fetch();
    }

    //добавление нового товара
    public static function addProduct($name, $price, $image, $category_id)
    {
        $query = Connection::make()->prepare("INSERT INTO system_blocks (name,price,image,category_id) VALUE (:name,:price,:image,:category_id)");
        $query->execute([
            ':name' => $name,
            ':price' => $price,
            ':image' => $image,
            ':category_id' => $category_id,
        ]);
    }

    //получаем продукт
    public static function getProduct($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM system_blocks WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        $product = $query->fetch();
        if ($product > 0) {
            return $product;
        }
        return null;
    }

    public static function deleteImage($id)
    {
        $imgQuery = Connection::make()->prepare("SELECT image FROM system_blocks WHERE id = :id");
        $imgQuery->execute([
            ':id' => $id
        ]);
        return $imgQuery->fetch();
    }

    //удаление товара
    public static function deleteProduct($id)
    {
        $img = self::deleteImage($id);
        if ($img != "") {
            unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/System-Block/" . $img->image);
        }

        $query = Connection::make()->prepare("DELETE FROM system_blocks WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }
}
