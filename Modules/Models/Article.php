<?php

namespace App\Modules\Models;

use App\Modules\Models\BaseModel;

class Article extends BaseModel
{
    public string $title;
    public string $subtitle;
    public string $body;

    protected function getAttributes()
    {
        return [
            'title',
            'subtitle',
            'body'
        ];
    }

    protected function getTableName()
    {
        return 'articles';
    }

    public function __construct(string $title, string $subtitle, string $body)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->body = $body;
    }
}
