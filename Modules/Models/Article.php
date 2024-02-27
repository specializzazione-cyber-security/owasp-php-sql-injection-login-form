<?php

namespace App\Modules\Models;

use App\Modules\Models\BaseModel;
use Carbon\Carbon;
use DateTime;

use function PHPSTORM_META\map;

class Article extends BaseModel
{
    public string $title;
    public string $subtitle;
    public string $body;
    public DateTime $created_at;
    public DateTime $updated_at;

    /**
     * Setta gli attributi che formano il modello
     * 
     * @return array
     */
    protected function getAttributes(): array
    {
        return [
            'title',
            'subtitle',
            'body',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Setta il nome della tabella nel database
     * 
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'articles';
    }

    /**
     * Costruisce l'istanza della classe
     */
    // public function __construct(string $title, string $subtitle, string $body)
    // {
    //     $this->title = $title;
    //     $this->subtitle = $subtitle;
    //     $this->body = $body;
    //     $this->created_at = Carbon::now();
    //     $this->updated_at = Carbon::now();
    // }
}
