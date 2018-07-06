@extends('admin.layouts.default')

@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首頁</a>
                </li>
            </ul>
        </div>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Auth::User()->name }}您好 !</strong>
            <? date_default_timezone_set("Asia/Shanghai") ?>
            現在時間 : {{ date('Y-m-d h:i:sa') }}
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <tr>
                    <th>創建時間</th>
                    <th>分類</th>
                    <th>標題</th>
                    <th>特色</th>
                    <th>觀看數</th>
                    <th>留言數</th>
                    <th>狀態</th>
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
                        <td class="center">
                            <span class="{{ ($article->status == '1') ? 'label-success label label-default' : 'label-default label' }}">{{ ($article->status == '1') ? '顯示' : '隱藏' }}</span>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- content ends -->
    </div><!--/#content.col-md-0-->
@stop