<?php

namespace App\Modules\Models;

use App\Modules\App;
use PDOException;
use PDOStatement;

abstract class BaseModel
{
    abstract protected function getAttributes(): array;
    abstract protected function getTableName(): string;

    /**
     * Costruisce una query di inserimento SQL compatibile con la sintassi SQL e utilizzabile con PDO.
     *
     * @param array $attributes
     * @param string $tableName
     * @return string
     */
    private function buildQuery(array $attributes, string $tableName): string
    {
        $queryFriendlyAttributes = implode(', ', $attributes);
        $placeholders = implode(', ', array_map(fn ($column) => ":$column", $attributes));
        return "INSERT INTO $tableName ($queryFriendlyAttributes) VALUES ($placeholders)";
    }

    /**
     * Associa i valori degli attributi della classe ai segnaposto nella query preparata.
     *
     * @param PDOStatement $statement
     * @param array $attributes
     * @return void
     */
    private function bindValues(PDOStatement $statement, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
    }

    /**
     * Salva l'istanza del modello nel database.
     * 
     * @return bool
     */
    public function save(): bool
    {
        $attributes = $this->getAttributes();
        $tableName = $this->getTableName();

        $query = $this->buildQuery($attributes, $tableName);

        try {
            $statement = App::$app->database->pdo->prepare($query);
            $this->bindValues($statement, $attributes);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Errore nel salvataggio: " . $e->getMessage());
            return false;
        }
    }
}
