<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
     // Authentication
     public function __construct()
     {
         $this->middleware('auth')->except(['index', 'detail']);
     }
    public function index() {
        // $data = [
        //     ['title' => 'Article one','name' => 'Name 1'],
        //     ['title' => 'Article two','name' => 'Name 2'],
        //     ['title' => 'Article three','name' => 'Name 3'],
        // ];
        // $data = Article::all();

        $data = Article::latest()->paginate(4);

        return view("articles.index", [
            "articles" => $data,
        ]);
    }

    public function detail($id) {
        $article = Article::find($id);

        return view("articles.detail", [
            "article" => $article
        ]);
    }

    public function delete($id) {
        $article = Article::find($id);
        if(Gate::allows('delete-articlce', $article)){
            $article->delete();
            return redirect("/articles")->with("info", "Your Articlen.$id was deleted!");
        }
        return back()->with("info", "Unauthorize to delete!");
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        // $article->user_id = request()->user_id;
        $article->save();
        return redirect("/articles");
    }

    public function add()
    {
        return view("articles.add");
    }

    public function create()
    {
        $validator = validator(request()->all(),[
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails())
        return back()->withErrors($validator);

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = Auth::id();

        $article->save();
        return redirect("/articles");
    }
}
