<?php

namespace App\Modules\Models;

use App\Modules\App;

abstract class BaseModel
{
    abstract protected function getAttributes();
    abstract protected function getTableName();

    public function save()
    {
        //recupero gli attributi del modello
        $attributes = implode(',', $this->getAttributes());

        //recupero il nome della tabella
        $tableName = $this->getTableName();

        //imposto i parametri del prepared statement -> :title, :subtitle...
        $params = implode(',', array_map(fn ($param) => ":$param", $this->getAttributes()));

        //creo query di salvataggio
        $statement = App::$app->database->pdo->prepare(
            "INSERT INTO $tableName ($attributes) VALUES ($params)"
        );

        //recupero il valore di uno specifico attributo dell'istanza
        foreach ($this->getAttributes() as $attribute) {
            $statement->bindValue(
                ":$attribute",
                $this->{$attribute}
            );
        }

        //eseguo la query
        try {
            $statement->execute();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
