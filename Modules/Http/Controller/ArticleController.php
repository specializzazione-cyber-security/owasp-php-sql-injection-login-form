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

    public function show()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::get($query);

        if (!$article) {
            http_response_code(404);
            return view('errors/404');
        }

        return view('article/show', [
            'article' => $article[0],
        ]);
    }

    public function edit()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::get($query);

        if (!$article) {
            http_response_code(404);
            return view('errors/404');
        }

        return view('article/edit', [
            'article' => $article[0],
        ]);
    }

    public function update()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::get($query);

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];

        $pdo = App::$app->database->pdo;
        $stmt = $pdo->prepare("UPDATE articles SET title = :title, subtitle = :subtitle, body = :body WHERE id = :id");
        $stmt->execute(['title' => $title, 'subtitle' => $subtitle, 'body' => $body, 'id' => $id]);

        return redirect('article/show?article_id=' . $id);
    }
}
