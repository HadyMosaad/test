<?php
/**
 * User: TheCodeholic
 * Date: 10/11/2020
 * Time: 10:51 AM
 */

namespace app\models;


use app\Database;
use app\helpers\UtilHelper;

/**
 * Class Product
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\models
 */
class Product
{
    public ?int $id = null;
    public string $sku;
    public string $name;
    public float $price;


    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->price = $data['price'];
    }

    public function save()
    {
        $errors = [];
        if (!is_dir(__DIR__ . '/../public/images')) {
            mkdir(__DIR__ . '/../public/images');
        }

        if (!$this->sku) {
            $errors[] = 'Product sku is required';
        }

        if (!$this->price) {
            $errors[] = 'Product price is required';
        }

        if (empty($errors)) {

            $db = Database::$db;
            if ($this->id) {
                $db->updateProduct($this);
            } else {
                var_dump($this);
                call_user_func(array($db, "create$class"),$this);
            }

        }
    }
}