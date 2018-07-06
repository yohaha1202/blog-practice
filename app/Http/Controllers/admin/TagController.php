<?php

namespace App\Http\Controllers\admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    function index()
    {
        return view('admin/tag/index')->with('tags',Tag::all());
    }

    public function create()
    {
        return view('admin/tag/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $tag = new Tag();
        $tag->name = $request->get('name');
        $tag->status = ($request->get('status') == 'on') ? '1' : '0';

        if ($tag->save()) {
            return redirect('admin/tags')->with('alert', '新增成功!');
        } else {
            return redirect('admin/tags')->with('alert', '新增失敗,請重新操作!');
        }
    }

    public function edit($id)
    {
        $tag = Tag::where('id', '=', $id)->first();
        return view('admin/tag/edit')->with('tag', $tag);
    }

    public function update(Request $request, $id)
    {
        Tag::where('id', $id)->update([
            'name' => $request->get('name'),
            'status' => ($request->get('status') == 'on') ? '1' : '0'
        ]);
        return redirect('admin/tags')->with('alert', '修改成功!');
    }

    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect('admin/tags')->with('alert', '删除成功!');
    }
}
