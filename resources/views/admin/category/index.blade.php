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
                    <a href="#">文章分類</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i>文章分類</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>

                    <div class="box-content">
                        <div style="margin-left:auto;margin-right:20px;width:50px;margin-top: 1px;">
                            <a href="{{ url('admin/categories/create') }}" class="btn btn-success">
                                <i class="glyphicon glyphicon-plus"></i>新增
                            </a>
                        </div>

                        @if (session('alert'))
                            <script>alert('<?= session('alert');?>');</script>
                        @endif
                        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                            <tr>
                                <th>分類名稱</th>
                                <th>建立日期</th>
                                <th>狀態</th>
                                <th>編輯</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="center">{{ $category->created_at }}</td>
                                    <td class="center">
                                        <span class="{{ ($category->status == '1') ? 'label-success label label-default' : 'label-default label' }}">{{ ($category->status == '1') ? '顯示' : '隱藏' }}</span>
                                    </td>
                                    <td class="center">
                                        <a class="btn btn-info" href="{{ url('admin/categories/'.$category->id.'/edit') }}">
                                            <i class="glyphicon glyphicon-edit icon-white"></i>
                                            編輯
                                        </a>
                                        <form action="{{ url('admin/categories/'.$category->id) }}" method="POST" style="display: inline;">
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