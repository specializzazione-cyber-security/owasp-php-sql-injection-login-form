<?php

namespace App\Modules\Http\Controller;

use Carbon\Carbon;
use App\Modules\Models\Article;

class ArticleController extends BaseController
{
    public function index()
    {
        $query = "SELECT * FROM articles";

        $articles = Article::get($query);

        return view('/article/index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('/article/create');
    }

    public function store()
    {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];

        $article = Article::insert([
            'title' => $title,
            'subtitle' => $subtitle,
            'body' => $body,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

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

        return view('/article/show', [
            'article' => $article[0],
        ]);
    }

    public function edit()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::get($query)[0];

        if (!$article) {
            http_response_code(404);
            return view('errors/404');
        }

        return view('/article/edit', [
            'article' => $article,
        ]);
    }

    public function update()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::get($query)[0];

        $article->update([
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'body' => $_POST['body'],
            'created_at' => $article->created_at,
            'update_at' => Carbon::now(),
        ]);

        return redirect('/article/show?article_id=' . $id);
    }
}
