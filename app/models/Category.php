<?php

namespace App\models;

use App\helpers\Connection;

class Category
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM categories");
        return $query->fetchAll();
    }
    
    //добавление новой категории
    public static function addCategory($name, $image)
    {
        $query = Connection::make()->prepare("INSERT INTO categories (name, image) VALUES (:name, :image)");
        $query->execute([
            ':name' => $name,
            ':image' => $image
        ]);
    }

    //получаем категорию
    public static function getCategory($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM categories WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        $category = $query->fetch();
        if ($category) {
            return $category;
        }
        return null;
    }

    //удаление категории
    public static function deleteCategory($id)
    {
        $query = Connection::make()->prepare("DELETE FROM categories WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }
}
