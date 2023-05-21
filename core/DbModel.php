<?php

namespace app\core;

use app\models\Book;
use app\models\Furniture;
use app\models\DVD;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function spesificAttributes(): array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = [...$this->spesificAttributes(), ...$this->attributes()];
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function fetchModels()
    {
        $tableName = $this->tableName();
        $statement = self::prepare("SELECT  *  From $tableName;");
        $statement->execute();
        $records = $statement->fetchAll();
        $allModels = [
            'DVD' => new DVD(),
            'Furniture' => new Furniture(),
            'Book' => new Book(),
        ];

        $loadedModels = [];
        foreach ($records as $record) {
            $type = $record['type'];
            $model = $allModels[$type];
            $model->loadData($record);
            array_push($loadedModels, $model);
        }

        return  $loadedModels;
    }

    public function deleteModels(array $ids)
    {
        $ids = implode(',', $ids);
        $tableName = $this->tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id IN($ids);");
        return $statement->execute();
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
