<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">Main</li>

                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 文章管理</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a class="ajax-link" href="{{ url('admin/categories') }}">
                                <i class="glyphicon glyphicon-barcode"></i>
                                <span> 分類</span>
                            </a>
                        </li>
                        <li>
                            <a class="ajax-link" href="{{ url('admin/articles') }}">
                                <i class="glyphicon glyphicon-file"></i>
                                <span> 文章</span>
                            </a>
                        </li>
                        <li>
                            <a class="ajax-link" href="{{ url('admin/tags') }}">
                                <i class="glyphicon glyphicon-tag"></i>
                                <span> 標籤</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->

<noscript>
    <div class="alert alert-block col-md-12">
        <h4 class="alert-heading">Warning!</h4>

        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
            enabled to use this site.</p>
    </div>
</noscript>
