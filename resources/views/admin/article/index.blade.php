@extends('layouts.default')

@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">文章管理</a>
                </li>
                <li>
                    <a href="#">文章管理</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i>文章管理</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>

                    <div class="box-content">
                        <div style="margin-left:auto;margin-right:20px;width:50px;margin-top: 1px;">
                            <a href="{{ url('admin/articles/create') }}" class="btn btn-success">
                                <i class="glyphicon glyphicon-plus"></i>新增
                            </a>
                        </div>

                        @if (session('alert'))
                            <script>alert('<?= session('alert');?>');</script>
                        @endif

                        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                            <tr>
                                <th>創建時間</th>
                                <th>分類</th>
                                <th>標題</th>
                                <th>特色</th>
                                <th>觀看數</th>
                                <th>留言數</th>
                                <th>愛心數</th>
                                <th>狀態</th>
                                <th>編輯</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td class="center">{{ $article->created_at }}</td>
                                    <td>
                                        @foreach ($article->categoryAry as $categoryName)
                                            <div class="btn btn-xs btn-warning"s>
                                                {{ $categoryName }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="center">{{ $article->title }}</td>
                                    <td class="center">{{ $article->features }}</td>
                                    <td class="center">{{ $article->view_num }}</td>
                                    <td class="center">{{ $article->comment_num }}</td>
                                    <td class="center">{{ $article->like_num }}</td>
                                    <td class="center">
                                        <span class="{{ ($article->status == '1') ? 'label-success label label-default' : 'label-default label' }}">{{ ($article->status == '1') ? '顯示' : '隱藏' }}</span>
                                    </td>
                                    <td class="center">
                                        <a class="btn btn-info" href="{{ url('admin/articles/'.$article->id.'/edit') }}">
                                            <i class="glyphicon glyphicon-edit icon-white"></i>
                                            編輯
                                        </a>
                                        <form action="{{ url('admin/articles/'.$article->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">
                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                                删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/span-->
        </div><!--/row-->
        <!-- content ends -->
    </div><!--/#content.col-md-0-->
@stop

<script>
    function alert(e){
        noty({
            text: e,
            type: 'success',
            layout:'topRight'
        });

    }
</script>