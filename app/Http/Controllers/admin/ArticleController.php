<?php

namespace App\Http\Controllers\admin;

use App\ArticleTag;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use App\ArticleCategory;

class ArticleController extends Controller
{
    public function index()
    {
        $catagories = Category::all();

        $categoryNames = [];
        foreach ($catagories as $category) {
            $categoryNames[$category->id] = $category->name;
        }

        $data = Article::all();

        foreach ($data as $d) {
            $pushAry = [];
            foreach ($d->articleCategories as $category_item) {
                $pushAry[$category_item->category_id] = $categoryNames[$category_item->category_id];
            }
            $d->categoryAry = $pushAry;
        }

        return view('admin/article/index')->with('articles',$data);
    }

    public function create()
    {
        return view('admin/article/create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function store(Request $request)
    {
        $photoName = '';
        if(isset($request->photo)) $photoName =  $this->updateImg($request->photo);

        $articles = new Article();
        $articles->title = $request->get('title');
        $articles->photo = $photoName;
        $articles->features = $request->get('features');
        $articles->short_desc = $request->get('short_desc');
        $articles->view_num = 0;
        $articles->comment_num = 0;
        $articles->like_num = 0;
        $articles->status = ($request->get('status') == 'on') ? '1' : '0';

        if ($articles->save()) {
            if(!empty($request->get('category_id'))) $this->addRelationData('category',$request->get('category_id'),$articles->id);
            if(!empty($request->get('tag_id'))) $this->addRelationData('tag',$request->get('tag_id'),$articles->id);

            return redirect('admin/articles')->with('alert', '新增成功!');
        } else {
            return redirect('admin/articles')->with('alert', '新增失敗,請重新操作!');
        }
    }

    public function edit($id)
    {
        $artice = Article::where('id', '=', $id)->first();
        $catagories = Category::all();

        $categoryNames = [];
        foreach ($catagories as $category) {
            $categoryNames[$category->id] = $category->name;
        }

        $tags = Tag::all();

        $tagNames = [];
        foreach ($tags as $tag) {
            $tagNames[$tag->id] = $tag->name;
        }

        $pushCategoryAry = [];

        foreach ($artice->articleCategories as $category_item) {
            $pushCategoryAry[$category_item->category_id] = $categoryNames[$category_item->category_id];
        }
        $artice->categoryAry = $pushCategoryAry;

        $pushTagAry = [];

        foreach ($artice->articleTags as $tag_item) {
            $pushTagAry[$tag_item->tag_id] = $tagNames[$tag_item->tag_id];
        }
        $artice->tagAry = $pushTagAry;

        return view('admin/article/edit')->with('articles',$artice)->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function update(Request $request ,$id)
    {
        $artice = Article::where('id', '=', $id)->first();

        $photoName = $artice->photo;

        if(isset($request->photo)) $photoName = $this->uploadImg($request->photo);

        Article::where('id',$id)->update([
            'title' => $request->title,
            'photo' => $photoName,
            'features' => $request->features,
            'short_desc' => $request->short_desc,
            'status' =>  ($request->get('status') == 'on') ? '1' : '0',
        ]);

        $this->deleteRelationData('category',$id);
        $this->deleteRelationData('tag',$id);

        if(!empty($request->category_id)) $this->addRelationData('category',$request->category_id,$id);
        if(!empty($request->tag_id)) $this->addRelationData('tag',$request->tag_id,$id);

        if(isset($request->photo)) $this->deleteImg($artice->photo);

        return redirect('admin/articles')->with('alert', '修改成功!');
    }

    public function destroy($id)
    {
        $artice = Article::where('id', '=', $id)->first();

        $this->deleteImg($artice->photo);
        $this->deleteRelationData('category',$id);
        $this->deleteRelationData('tag',$id);
        Article::find($id)->delete();

        return redirect('admin/articles')->with('alert', '删除成功!');
    }

    private function addRelationData($type,$relationAry,$articleId)
    {
        switch ($type){
            case 'category':
                foreach ($relationAry as $categoryId){
                    $article_categories = new ArticleCategory();
                    $article_categories->article_id = $articleId;
                    $article_categories->category_id = $categoryId;
                    $article_categories->save();
                }
                break;
            case'tag':
                foreach ($relationAry as $tagId){
                    $article_tags = new ArticleTag();
                    $article_tags->article_id = $articleId;
                    $article_tags->tag_id = $tagId;
                    $article_tags->save();
                }
                break;
        }
    }

    private function deleteRelationData($type,$articleId)
    {
        switch ($type){
            case 'category':
                ArticleCategory::where('article_id',"=",$articleId)->delete();
                break;
            case'tag':
                ArticleTag::where('article_id',"=",$articleId)->delete();
                break;
        }
    }

    private function uploadImg($photo)
    {
        $file = $photo;
        $extension = $file->getClientOriginalExtension();
        $file_name = strval(time()).str_random(5).'.'.$extension;
        $destination_path = public_path().'/images/';

        $file->move($destination_path, $file_name);

        return $file_name;
    }

    private function deleteImg($filePath)
    {
        if (file_exists(public_path().'/images/'.$filePath)) {
            unlink(public_path().'/images/'.$filePath);
        }
    }
}
