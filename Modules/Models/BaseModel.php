<?php

namespace App\Modules\Models;

use PDO;
use DateTime;
use PDOException;
use PDOStatement;
use App\Modules\App;
use Doctrine\Inflector\InflectorFactory;

abstract class BaseModel
{
    protected $inflector;

    abstract protected function getAttributes(): array;

    protected static function getTableName(): string
    {
        $className = substr(strrchr(static::class, "\\"), 1);
        $inflector = InflectorFactory::create()->build();
        $pluralClassName = $inflector->pluralize($className);

        return strtolower($pluralClassName);
    }

    /**
     * Salva l'oggetto corrente nel database.
     *
     * @return bool
     * @deprecated
     */
    // public function save(): bool
    // {
    //     $attributes = $this->getAttributes();
    //     $tableName = $this->getTableName();

    //     $query = $this->buildQuery($attributes, $tableName);

    //     try {
    //         $statement = App::$app->database->pdo->prepare($query);
    //         $this->bindValues($statement, $attributes);
    //         $statement->execute();
    //         return true;
    //     } catch (PDOException $e) {
    //         error_log("Errore nel salvataggio: " . $e->getMessage());
    //         return false;
    //     }
    // }

    /**
     * Esegue una query SQL di selezione e restituisce i risultati.
     *
     * @param string $query
     * @return array
     */
    public static function get($query)
    {
        $pdo = App::$app->database->pdo;
        $statement = $pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];

        foreach ($result as $record) {
            $article = new Article();

            foreach ($record as $key => $value) {
                if ($key === 'updated_at') {
                    $article->updated_at = new DateTime($value);
                } else if ($key === 'created_at') {
                    $article->created_at = new DateTime($value);
                } else {
                    $article->$key = $value;
                }
            }

            $articles[] = $article;
        }

        return $articles;
    }

    /**
     * Costruisce e restituisce una query di inserimento SQL compatibile con la sintassi SQL e utilizzabile con PDO.
     * todo: astrarre questa funzione in modo che possa essere utilizzata anche per le query di insert, update, delete.
     * @param array $attributes
     * @param string $tableName
     * @return string
     */
    private static function buildQuery(array $attributes, string $tableName): string
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
     * @deprecated
     */
    // private function bindValues(PDOStatement $statement, array $attributes): void
    // {
    //     foreach ($attributes as $attribute) {
    //         $statement->bindValue(":$attribute", $this->{$attribute});
    //     }
    // }

    /**
     * Salva un nuovo record nel database.
     *
     * @param array $params
     *
     * @return bool
     */
    public static function insert(array $params): bool
    {
        $tableName = static::getTableName();
        $attributes = array_keys($params);
        $values = array_values($params);

        $query = self::buildQuery($attributes, $tableName);

        try {
            $statement = App::$app->database->pdo->prepare($query);

            //todo: creare funzione bindValues
            foreach ($attributes as $key => $attribute) {
                $statement->bindValue(":$attribute", $values[$key]);
            }

            $statement->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Errore nel salvataggio: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Aggiorna il record nel database con i nuovi valori forniti.
     *
     * @param array $params
     *
     * @return bool
     */
    public function update(array $params): bool
    {
        $tableName = static::getTableName();
        $attributes = array_keys($params);
        $values = array_values($params);

        $pdo = App::$app->database->pdo;

        $placeholders = array_map(fn ($column) => ":$column", $attributes);

        try {
            foreach ($attributes as $key => $attribute) {
                if ($values[$key] instanceof DateTime) {
                    $values[$key] = $values[$key]->format('Y-m-d H:i:s');
                }

                $stmt = $pdo->prepare("UPDATE $tableName SET $attribute = $placeholders[$key] WHERE id = $this->id");

                $stmt->bindValue($placeholders[$key], $values[$key]); // Usare il placeholder invece del nome della colonna

                $stmt->execute();
            }

            return true;
        } catch (PDOException $e) {
            error_log("Errore nel salvataggio: " . $e->getMessage());

            return false;
        }
    }

    public function destroy(): bool
    {
        $tableName = static::getTableName();
        $pdo = App::$app->database->pdo;

        try {
            $statement = $pdo->prepare("DELETE FROM $tableName WHERE id = $this->id");
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Errore nella cancellazione: " . $e->getMessage());
            return false;
        }
    }
}
