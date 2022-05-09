<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;
class  Furniture extends Product
{
    public $height;
    public $width;
    public $length;

    public function load($data)
    {
        parent::load($data);
        $this->height = $data['height'];
        $this->length= $data['length'];
        $this->width = $data['width'];

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
                $db->createFurniture($this);
            }
        }
    }
    public function validateAttributes()
    {
        if(is_numeric($this->inputs['weight']) && floatval($this->inputs['weight'] >= 0))
        {
            $this->attribute = $this->inputs['weight'].' KG';
            return true;
        }

        return false;
    }
};