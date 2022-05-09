<?php
namespace app\models;
use app\Database;
use app\helpers\UtilHelper;

class Disk extends Product
{
    public $size;
    public function load($data)
    {
        parent::load($data);
        $this->size = $data['size'];

    }

    public function validateAttributes()
    {
        if(is_numeric($this->inputs['size']) && floatval($this->inputs['size'] >= 0))
        {
            $this->attribute = $this->inputs['size'].' MB';
            return true;
        }

        return false;
    }
};