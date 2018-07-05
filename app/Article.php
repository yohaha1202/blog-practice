<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function articleCategories()
    {
        return $this->hasMany('App\ArticleCategory');
    }

    public function articleTags()
    {
        return $this->hasMany('App\ArticleTag');
    }
}
