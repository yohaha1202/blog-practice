@extends('admin.layouts.default')

@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">文章分類</a>
                </li>
                <li>
                    <a href="#">新增分類</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 新增分類</h2>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>新增失败</strong> 输入不符合要求<br><br>
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
                            <form action="{{ url('admin/categories') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">分類名稱</label>
                                    <input type="text" class="form-control" style="width: 400px" name="name"
                                           placeholder="Enter name" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">分類狀態</label>
                                    <input data-no-uniform="true" name="status" type="checkbox"
                                           class="iphone-toggle">
                                </div>
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
@stop