@extends('admin.layouts.default')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">文章分類</a>
                </li>
                <li>
                    <a href="#">修改文章</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 新增文章</h2>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>修改失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-content">
                            <form action="{{ url('admin/articles/'.$articles->id)  }}" method="POST" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}

                                <div class="control-group">
                                    <label class="control-label" for="selectError1">文章分類</label>
                                    <div class="controls">
                                        <select name="category_id[]" multiple class="form-control" data-rel="chosen" style="height: 500px;">
                                            @foreach ($categories as $category)
                                                {{ $choose = false }}
                                                @foreach($articles->categoryAry as $key => $data)
                                                    @if($key == $category->id)
                                                        {{ $choose = true }}
                                                    @endif
                                                @endforeach
                                                <option value="{{ $category->id }}" {{ ($choose) ? 'selected' : '' }}> {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label for="exampleInputFile">列表主圖</label>
                                    <input type="file" name="photo">{{ $articles->photo }}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">文章標題</label>
                                    <input type="text" class="form-control" style="width: 400px" name="title"
                                           placeholder="Enter title" required="required" value="{{ $articles->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">文章狀態</label>
                                    <input data-no-uniform="true" name="status" type="checkbox"
                                           class="iphone-toggle"  {{ ($articles->status == '1') ? 'checked':'' }}>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">文章特色</label><br>
                                    <textarea class="message" id="features" name="features" style="height: 150px; width:1000px; " required="required">{{ $articles->features }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">文章內容</label><br>
                                    <textarea class="message" id="short_desc" name="short_desc" style="height: 200px; width:1000px; " required="required">{{ $articles->short_desc }}</textarea>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError1">文章標籤</label>
                                    <div class="controls">
                                        <select name="tag_id[]" multiple class="form-control" data-rel="chosen" style="height: 500px;">
                                            @foreach ($tags as $tag)
                                                {{ $choose = false }}
                                                @foreach($articles->tagAry as $key => $data)
                                                    @if($key == $tag->id)
                                                        {{ $choose = true }}
                                                    @endif
                                                @endforeach
                                                <option value="{{ $tag->id }}" {{ ($choose) ? 'selected' : '' }}> {{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div style="margin-left:auto;margin-right:2px;width:80px;">
                                    <button style="right: 10px;"  class="btn  btn-info">確定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/span-->
        </div><!--/row-->
        <!-- content ends -->
    </div><!--/#content.col-md-0-->
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace('short_desc',options);
    </script>
@stop