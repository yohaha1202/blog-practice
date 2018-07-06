@extends('admin.layouts.default')

@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">修改</a>
                </li>
                <li>
                    <a href="#">個人資料修改</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 修改個人資料</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    @if (session('alert'))
                        <script>alert('<?= session('alert');?>');</script>
                    @endif
                    <div class="box-content">
                        <div class="box-content">
                            <form action="{{ url('admin/personal/update')  }}" method="POST" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">姓名/暱稱</label>
                                    <input type="text" class="form-control" style="width: 400px" name="name" placeholder="Enter title" required="required" value="{{ Auth::User()->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">大頭貼</label>
                                    <input type="file" name="photo">{{ Auth::User()->photo }}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">簡介</label><br>
                                    <textarea class="message" name="introduction" style="height: 200px; width:1000px; " required="required">{{ Auth::User()->introduction }}</textarea>
                                </div>

                                <br><br>
                                <a href="javascript:void(0)" onclick="modifyPassword()" class="btn btn-success">
                                    修改密碼
                                </a>
                                <br>
                                <div class="password" <?= ($errors->has('password')) ? '' : 'style="display: none"' ?>>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">密碼</label><br>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">再次輸入密碼</label><br>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div style="margin-left:auto;margin-right:2px;width:80px;">
                                    <button style="right: 10px;"  class="btn btn-info">確定</button>
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

<script>
    function alert(e){
        noty({
            text: e,
            type: 'success',
            layout:'topRight'
        });
    }
    function modifyPassword(){
        $('.password').css('display', '');
    }
</script>