<?php
namespace app\models;

class Furniture extends Products
{
    public string $height;
    public string $width;
    public string $length;

    public function getType()
    {
        return 'furniture';
    }

    public function spesificAttributes():array
    {
        return ['height', 'width', 'length'];
    }

    public function rules(): array
    {
        $product = new Products();
        return [ ...$product->rules(),
            'height'=> [self::RULE_REQUIRED],
            'width'=>[ self::RULE_REQUIRED],
            'length'=> [self::RULE_REQUIRED],
        ];
    }

    public function __toString()
    {
        return "<span>dimentions: </span><span>$this->height*$this->width*$this->length</span>";
    }
}