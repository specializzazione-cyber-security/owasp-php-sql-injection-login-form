<?php

namespace App\Modules\Models;

use App\Modules\App;
use PDOException;
use PDOStatement;

abstract class BaseModel
{
    abstract protected function getAttributes(): array;
    abstract protected function getTableName(): string;

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

    private function buildQuery(array $attributes, string $tableName)
    {
        $queryFriendlyAttributes = implode(', ', $attributes);
        $placeholders = implode(', ', array_map(fn ($column) => ":$column", $attributes));
        return "INSERT INTO $tableName ($queryFriendlyAttributes) VALUES ($placeholders)";
    }

    private function bindValues(PDOStatement $statement, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
    }
}
