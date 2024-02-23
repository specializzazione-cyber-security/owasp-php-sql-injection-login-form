<?php

namespace App\Modules\Models;

use App\Modules\Models\BaseModel;

class Article extends BaseModel
{
    public string $title;
    public string $subtitle;
    public string $body;

    /**
     * Setta gli attributi che formano il modello
     */
    protected function getAttributes(): array
    {
        return [
            'title',
            'subtitle',
            'body'
        ];
    }

    /**
     * Setta il nome della tabella nel database
     */
    protected function getTableName(): string
    {
        return 'articles';
    }

    /**
     * Costruisce l'istanza della classe
     */
    public function __construct(string $title, string $subtitle, string $body)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->body = $body;
    }
}
