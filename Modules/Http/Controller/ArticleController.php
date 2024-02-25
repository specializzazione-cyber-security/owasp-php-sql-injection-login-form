<?php

namespace App\Modules\Http\Controller;

use PDO;
use App\Modules\App;
use App\Modules\Models\Article;

class ArticleController extends BaseController
{
    public function index()
    {
        $query = "SELECT * FROM articles";

        $articles = Article::get($query);

        return view('article/index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('article/create');
    }

    public function store()
    {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];

        $article = new Article($title, $subtitle, $body);

        $article->save();
        return redirect('/');
    }
}
