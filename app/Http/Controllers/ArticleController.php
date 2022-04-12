<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 0){
            $articles = Article::when(isset(request()->search),function ($q){
                $search = request()->search;
                return $q->where("title","like","%$search%")->orwhere("description","like","%$search%");
            })->
            with('user','category')->latest("id")->paginate(7);
        }else{
            $articles = Article::when(isset(request()->search),function ($q){
                $search = request()->search;
                return $q->where("title","like","%$search%")->orwhere("description","like","%$search%");
            })->where('user_id',Auth::id())
            ->with('user','category')->latest("id")->paginate(7);
        }

        return view("article.index",compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "category" => "required|exists:categories,id",
            "title" => "required|min:5|max:200",
            "description" => "required|min:5"
        ]);
//        return $request;
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->user_id = Auth::id();
        $article->category_id = $request->category;
        $article->save();

        return redirect()->route('article.index')->with("toast",["icon"=>"success","title"=>$article->title." created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',compact("article"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            "category" => "required|exists:categories,id",
            "title" => "required|min:5|max:200",
            "description" => "required|min:5"
        ]);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
        $article->update();

        return redirect()->route('article.index')->with("toast",["icon"=>"success","title"=>$article->title." updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route("article.index",["page"=>request()->page])->with("toast",["icon"=>"success","title"=>$article->title." deleted successfully"]);
    }
}
