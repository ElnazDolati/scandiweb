<?php
namespace app\models;

class DVD extends Products
{
    public string $size = '';

    public function getType()
    {
        return 'DVD';
    }
    public function spesificAttributes():array
    {
        return ['size'];
    }
    public function rules(): array
    {
        $product = new Products();
        return [ ...$product->rules(),
            'size'=> [self::RULE_REQUIRED]
        ];
    }

    public function __toString()
    {
        return "<span>Size: </span><span>$this->size MB</span>";
    }

}