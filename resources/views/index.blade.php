@extends('layouts.default', array('category'=>$catrgory))
@if (session('alert'))
	<script>alert('<?= session('alert');?>');</script>
@endif
<style>
	* {
		padding: 0;
		box-sizing: border-box;
	}
	.box {
		position: relative;
		overflow: hidden;
	}
	.box:hover img {
		transform: scale(1.5);
	}
	.box:hover .box-hover-text {
		display: block;
	}
	.box .box-hover-text {
		width: 100%;
		height: 100%;
		position: absolute; */
	left: 0;
		top: 0;
		display: none;
		background-color: rgba(0,0,0, 0.7);
	}
	.box .box-body {
		color: #fff;
	}
	h2.box-body {
		padding-top: 10px;
		text-align: center;
	}
	p.box-body {
		padding: 15px;
		line-height: 1.8em;
	}
	.box .box-see-more {
		width: 100px;
		height: 50px;
		line-height: 50px;
		background-color: #b0e0e6;
		position: absolute;
		right: 30px;
		bottom: 10px;
		border-radius: 5px;
		text-align: center;
	}
	.box-see-more a {
		text-decoration: none;
		color: #000;
	}
	.box-see-more a:hover {
		color: #69868a;
	}
</style>
@section('content')
<div class="container-fluid">
	<div class="row fh5co-post-entry">
		@foreach($article as $item)
			<article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
				<div class="box">
					<figure>
						<a href="{{ url('info/'.$item->id) }}">
							<img src="{{ '/images/'.$item->photo }}" alt="{{ $item->title }}" class="img-responsive">
						</a>
					</figure>
					<div class="box-hover-text">
						<p class="box-body"><?= nl2br($item->features) ?></p>
						<div class="box-see-more">
							<a href="{{ url('info/'.$item->id) }}">看更多</a>
						</div>
					</div>
					<span class="fh5co-meta">
						<a href="{{ url('info/'.$item->id) }}">
							@foreach ($item->categoryAry as $categoryName)
								{{ $categoryName }}&nbsp;&nbsp;
							@endforeach
						</a>
					</span>
				</div>
				<h2 class="fh5co-article-title">
					<a href="{{ url('info/'.$item->id) }}">{{ $item->title }}</a>
				</h2>
				<span class="fh5co-meta fh5co-date">{{ $item->created_at }}</span>
			</article>
		@endforeach
	</div>
</div>
@stop