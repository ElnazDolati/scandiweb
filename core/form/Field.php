<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_NUMBER = 'number';
    
    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute = '')
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class="form-group">
                <label>%s</label>
                <input type="%s" name="%s" id="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function dropdown()
    {
        $innerItems = "<option value='none' disabled selected>please select type</option>";
        foreach($this->model->getAlltypes() as $type){
            $innerItems.= "<option value= '".$type."' >".$type."</option>";
        }
        
        return sprintf(
            '
            <label style="
            margin-block-start: 20px;
            margin-block-end: 20px
            ">
            select type
            </label>
            <select class="form-control" id="productType" style="margin-block-end: 20px"
            >
           %s
          </select>
        ',
        $innerItems
        );
    }

    public function getInputs($attributes){
        $inputs = '';

        foreach($attributes as $attribute){
            $inputs .= sprintf(
                '
                <div class="form-group">
                    <label>%s</label>
                    <input type="%s" name="%s" id="%s" class="form-control %s">
                    <div class="invalid-feedback">
                        %s
                    </div>
                </div>
            ',
                $attribute,
                $this->type,
                $attribute,
                strtolower($attribute),
                $this->model->hasError($attribute) ? ' is-invalid' : '',
                $this->model->getFirstError($attribute)
            );
        }
        return $inputs;
    }
}
