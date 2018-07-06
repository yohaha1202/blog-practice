<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Comment;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $articleData = Article::where('status', '1')->get();

        $articleData = $this->getArticleCategoryAry($articleData);

        return view('index')->with('article', $articleData)->with('catrgory', Category::where('status','=','1')->get())->with('user',User::where('id','1')->first());
    }

    public function search(Request $request)
    {
        if(!empty($request->categoryId)){
            $articleData = Article::where('status', '1')
                ->join('article_categories', function ($join) use ($request) {
                    $join->on('article_categories.article_id', '=', 'articles.id')
                        ->where('article_categories.category_id', '=', $request->categoryId);
                })
                ->select('articles.id','articles.title','articles.created_at','articles.photo')
                ->get();
        }else if(!empty($request->keyword)){
            $articleData = Article::where('status', '1')->where('title', 'like', '%' . $request->keyword . '%')->get();
        }

        $articleData = $this->getArticleCategoryAry($articleData);

        return view('index')->with('article', $articleData)->with('catrgory', Category::where('status','=','1')->get())->with('user',User::where('id','1')->first());
    }

    private function getArticleCategoryAry($articleData)
    {
        $catagories = Category::all();

        $categoryNames = [];
        foreach ($catagories as $category) {
            $categoryNames[$category->id] = $category->name;
        }

        foreach ($articleData as $d) {
            $pushAry = [];
            foreach ($d->articleCategories as $category_item) {
                $pushAry[$category_item->category_id] = $categoryNames[$category_item->category_id];
            }
            $d->categoryAry = $pushAry;

            if(strlen ( $d->title ) >='21'){
                $d->title = mb_substr( $d->title , 0 , 5 ).' ..';
            }
        }
        return $articleData;
    }

    public function info($id)
    {
        $articleData = Article::where('status', '1')->where('id',$id)->first();

        Article::where('id',$id)->update([
            'view_num' => ($articleData->view_num + 1)
        ]);

        if(empty($articleData)){
            return redirect('/')->with('alert', '資料錯誤,請重新操作!');
        }

        $catagories = Category::where('status', '1')->get();

        $categoryNames = [];
        foreach ($catagories as $category) {
            $categoryNames[$category->id] = $category->name;
        }

        $tags = Tag::where('status', '1')->get();

        $tagNames = [];
        foreach ($tags as $tag) {
            $tagNames[$tag->id] = $tag->name;
        }

        $pushCategoryAry = [];

        foreach ($articleData->articleCategories as $category_item) {
            $pushCategoryAry[$category_item->category_id] = $categoryNames[$category_item->category_id];
        }
        $articleData->categoryAry = $pushCategoryAry;

        $pushTagAry = [];

        foreach ($articleData->articleTags as $tag_item) {
            $pushTagAry[$tag_item->tag_id] = $tagNames[$tag_item->tag_id];
        }

        $articleData->tagAry = $pushTagAry;

        $articleData->commentAry = Comment::where('articles_id', $id)->get();

        $articleData->nextId = $this->getNextId($id);
        $articleData->previousId = $this->getPreviousId($id);

        return view('info')->with('article', $articleData)->with('catrgory', $catagories)->with('user',User::where('id','1')->first());
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->articles_id = $request->get('id');
        $comment->content = $request->get('content');
        $comment->name = $request->get('name');

        $artice = Article::where('id', '=', $request->get('id'))->first();

        if($comment->save()){
            Article::where('id',$request->get('id'))->update([
                'comment_num' => ($artice->comment_num + 1)
            ]);

            return redirect('/info/'.$request->get('id'))->with('alert', '新增成功!');
        }else{
            return redirect('/info/'.$request->get('id'))->with('alert', '新增失敗,請重新操作!');
        }
    }

    /*
     * find the next article id for article info
     * @param $id
     * $return $id
     */
    public function getNextId($id)
    {
        $next = Article::where('status', '1')->where('id' , '>' , $id)->min('id');
        return $next;
    }

    /*
     * find the previous article id for article info
     * @param $id
     * $return $id
     */
    public function getPreviousId($id)
    {
        $previous = Article::where('status', '1')->where('id' , '<' , $id)->max('id');
        return $previous;
    }
}
