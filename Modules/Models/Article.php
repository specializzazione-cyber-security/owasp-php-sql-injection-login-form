<?php

namespace App\Modules\Models;

use DateTime;
use Carbon\Carbon;
use AllowDynamicProperties;

use function PHPSTORM_META\map;
use App\Modules\Models\BaseModel;

#[AllowDynamicProperties]
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
     * @deprecated
     */
    // protected static function getTableName(): string
    // {
    //     return 'articles';
    // }

    /**
     * Costruisce l'istanza della classe
     * 
     * @deprecated
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
