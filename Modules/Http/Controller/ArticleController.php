<?php

namespace App\Modules\Http\Controller;

use Carbon\Carbon;
use App\Modules\Models\Article;

class ArticleController extends BaseController
{
    public function index()
    {
        $query = "SELECT * FROM articles";

        $articles = Article::select($query);

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

        Article::insert([
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
        $article = Article::select($query);

        if (!$article) {
            http_response_code(404);
            return view('errors/404');
        }

        return view('/article/show', [
            'article' => $article,
        ]);
    }

    public function edit()
    {
        $id = explode("=", $_SERVER["QUERY_STRING"])[1];

        if (!$id) return redirect("/");

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::select($query);

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
        $article = Article::select($query);

        $article->update([
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'body' => $_POST['body'],
            'created_at' => $article->created_at,
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/article/show?article_id=' . $id);
    }

    public function destroy()
    {
        $id = explode("=", $_SERVER['QUERY_STRING'])[1];

        if (!$id) return redirect('/');

        $query = "SELECT * FROM articles WHERE id = $id";
        $article = Article::select($query)[0];

        $article->destroy();

        return redirect('/article/index');
    }
}
