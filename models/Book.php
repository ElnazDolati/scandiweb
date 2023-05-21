<?php
namespace app\models;

class Book extends Products
{
    public string $weight = '';

    public function getType()
    {
        return 'Book';
    }
    
    public function spesificAttributes():array
    {
        return ['weight'];
    }

    public function rules(): array
    {
        $product = new Products();
        return [ ...$product->rules(),
            'weight'=>[ self::RULE_REQUIRED]
        ];
    }

    public function __toString()
    {
        return "<span>weight: </span><span>$this->weight KG</span>";
    }

}