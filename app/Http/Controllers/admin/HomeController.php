<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
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
        return view('admin/home')->with('articles',$data);

    }
}
