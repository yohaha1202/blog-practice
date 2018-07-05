<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin/category/index')->with('categories',Category::all());
    }

    public function create()
    {
        return view('admin/category/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->status = ($request->get('status') == 'on') ? '1' : '0';

        if ($category->save()) {
            return redirect('admin/categories')->with('alert', '新增成功!');
        } else {
            return redirect('admin/categories')->with('alert', '新增失敗,請重新操作!');
        }
    }

    public function edit($id)
    {
        $category = Category::where('id', '=', $id)->first();
        return view('admin/category/edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->get('name'),
            'status' => ($request->get('status') == 'on') ? '1' : '0'
        ]);
        return redirect('admin/categories')->with('alert', '修改成功!');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('admin/categories')->with('alert', '删除成功!');
    }
}
