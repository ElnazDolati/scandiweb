<?php
namespace app\models;

use app\core\DbModel;

class Products extends DbModel
{
    public string $id ;
    public string $sku = '';
    public string $name = '';
    public string $price = '';
    public string $type = '';

    public function spesificAttributes(): array
    {
        return [];
    }
    public function getType()
    {
        return 'general';
    }
    public function attributes(): array
    {
        return ['sku', 'name', 'price','type'];
    }
    public function tableName(): string
    {
        return 'products';
    }

    public function getAllTypes(){
        return ['Book','DVD','Furniture'];
    }
    
    public function rules(): array
    {
        return [
            'sku'=> [self::RULE_REQUIRED],
            'name'=> [self::RULE_REQUIRED],
            'price'=> [self::RULE_REQUIRED],
            'type'=> [self::RULE_REQUIRED],
        ];
    }

}