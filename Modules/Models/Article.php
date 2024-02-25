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
     * 
     * @return array
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
     * 
     * @return string
     */
    protected function getTableName(): string
    {
        return 'articles';
    }

    /**
     * Costruisce l'istanza della classe
     * 
     * @param string $title
     * @param string $subtitle
     * @param string $body
     */
    public function __construct(string $title, string $subtitle, string $body)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->body = $body;
    }
}
