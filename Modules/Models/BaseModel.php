<?php

namespace App\Modules\Models;

use PDO;
use PDOException;
use PDOStatement;
use App\Modules\App;

abstract class BaseModel
{
    abstract protected function getAttributes(): array;
    abstract protected function getTableName(): string;

    /**
     * Salva l'oggetto corrente nel database.
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

    /**
     * Esegue una query SQL di selezione e restituisce i risultati.
     *
     * @param string $query
     * @return array
     */
    public static function get($query): array
    {
        $pdo = App::$app->database->pdo;
        $statement = $pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll($pdo::FETCH_ASSOC);

        return $result;
    }

    /**
     * Costruisce e restituisce una query di inserimento SQL compatibile con la sintassi SQL e utilizzabile con PDO.
     * todo: astrarre questa funzione in modo che possa essere utilizzata anche per le query di insert, update, delete.
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
}
